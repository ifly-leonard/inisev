<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Providers\RouteServiceProvider;

/**
 *
 * An API controller that returns ALL the data of specific models present in the system.
 *
 **/

class GetDataController extends Controller
{

    /**
     *
     * API Version number, returned from RouteServiceProvider.
     *
     */
    public CONST VERSION = RouteServiceProvider::API_VERSION;


    /**
     * The pagination value for each response.
     */

    public CONST PAGINATION = 5;

    /**
     * users - returns all the users
     *
     * @return json
     */
    public function users() {
        $response = collect([
            'success' => true,
            'message' => 'All the users present in '. config('app.name'),
            'api_version' => self::VERSION,
            'model_data' => User::paginate(self::PAGINATION),
        ]);

        return response()->json($response);
    }


    /**
     * subscriptions - returns all the subscriptions
     *
     * @return json
     */
    public function subscriptions() {
        $response = collect([
            'success' => true,
            'message' => 'All the subscriptions present in '. config('app.name'),
            'api_version' => self::VERSION,
            'model_data' => Subscription::paginate(self::PAGINATION),
        ]);

        return response()->json($response);
    }

    /**
     * posts - returns all the posts
     *
     * @return json
     */
    public function posts() {
        $response = collect([
            'success' => true,
            'message' => 'All the posts present in '. config('app.name'),
            'api_version' => self::VERSION,
            'model_data' => Post::paginate(self::PAGINATION),
        ]);

        return response()->json($response);
    }

     /**
     * websites - returns all the websites
     *
     * @return json
     */
    public function websites() {
        $response = collect([
            'success' => true,
            'message' => 'All the websites present in '. config('app.name'),
            'api_version' => self::VERSION,
            'model_data' => Website::paginate(self::PAGINATION),
        ]);

        return response()->json($response);
    }
}
