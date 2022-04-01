<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Website;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\StoreSubscriptionRequest;

/**
 *
 * An API controller that returns ALL the data of subscriptions.
 *
 **/


class SubscriptionsAPIController extends Controller
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
     * all - returns all the subscriptions
     *
     * @return json
     */
    public function all() {

        $response = collect([
            'success' => true,
            'message' => 'All the subscriptions as per the websites present in '. config('app.name'). 'The relationships are eager loaded',
            'api_version' => self::VERSION,
            'model_data' => Subscription::with(['user', 'website'])->paginate(self::PAGINATION), #Eager loeading the relationships
        ]);

        return response()->json($response);
    }


    /**
     * check_if_there_are_duplicate_entries_for_subscriptions - the fn name literally explains lol.
     *
     * @param  mixed $user
     * @param  mixed $website
     * @return boolean
     */
    protected function check_if_there_are_duplicate_entries_for_subscriptions($user, $website) {
        if(Subscription::where('user_id', $user)->where('website_id', $website)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * subscribe - A user can subscribe to a website.
     *
     * @param  mixed $user
     * @param  mixed $website
     * @return json
     */
    public function subscribe(User $user, Website $website) {

        # Double checking if there is a dupelicate value.
        if($this->check_if_there_are_duplicate_entries_for_subscriptions($user->id, $website->id)) {
            $subscribe = new Subscription;
            $subscribe->user_id = $user->id;
            $subscribe->website_id = $website->id;
            $subscribe->save();
            $message = 'User: '. $user->name.' has successfully subscribed to '. $website->url;
        } else {
            $message = 'Warning: User: '. $user->name.' is ALREADY subscribed to '. $website->url;
        }

        return response()->json([
            'success' => true,
            'api_version' => self::VERSION,
            'message' => $message,
        ]);
    }
}
