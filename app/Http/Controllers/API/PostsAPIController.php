<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\Website;
use App\Events\PostEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\APIServiceProvider;
use App\Http\Requests\StorePostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * An API controller that creates a post and dispatches an event.
 *
 **/

class PostsAPIController extends Controller
{


    /**
     *
     * API Version number, returned from APIServiceProvider.
     *
     */
    public CONST VERSION = APIServiceProvider::API_VERSION;



    /**
     * create - Create a post using API.
     *
     * @param  mixed $request
     * @param  object $website
     * @return json
     */
    public function create(StorePostRequest $request, Website $website) : JsonResponse {

        # Validation is handled by the StorePostRequest.

        $post = new Post;
        $post->website_id = $website->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        # Sending out an event
        event(new PostEvent($post));

        return response()->json([
            'success' => true,
            'api_version' => self::VERSION,
            'message' => 'Post has been created for website: '.$website->url,
            'post_id' => $post->id,
        ]);
    }
}
