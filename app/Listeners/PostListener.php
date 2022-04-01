<?php

namespace App\Listeners;

use App\Models\Post;
use App\Models\Website;
use App\Events\PostEvent;
use App\Models\Subscription;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\SendEmailNotificationsForSubscribers;

class PostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostEvent  $event
     * @return void
     */
    public function handle(PostEvent $event)
    {

        # Find the website the post was made to
        $website = Website::find($event->post->website_id);
        $post = Post::find($event->post->id);

        # Find all subscribers of that website
        $all_subscribers = Subscription::where('website_id', $website->id)->get();

        foreach($all_subscribers as $subscribers) {

            # Queue e-mail notifications to all of them.

            $data = (object) [
                'user' => $subscribers->user,
                'post' => $post,
                'website' => $website,
            ]; # We're passing all the vars as a single object, so that we don't have to pass multiple things.


            SendEmailNotificationsForSubscribers::dispatch($data);
        }
    }
}
