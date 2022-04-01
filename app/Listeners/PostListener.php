<?php

namespace App\Listeners;

use App\Models\Post;
use App\Models\Website;
use App\Models\EmailLog;
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
     * check_if_email_was_already_sent - This returns an integer, but should be 0 if all conditions are favorable.
     *
     * @return integer
     */
    public function check_if_email_was_already_sent($data) {
        return EmailLog::where([
            'post_id' => $data->post->id,
            'website_id' => $data->website->id,
            'user_id' => $data->user->id,
        ])->count();
    }

    /**
     * create_entry_for_email - Add the email entry into the database.
     *
     * @return void
     */
    public function create_entry_for_email($data) {

        $email = new EmailLog;
        $email->post_id = $data->post->id;
        $email->website_id = $data->website->id;
        $email->user_id = $data->user->id;
        $email->save();

        return $email->id;
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



            if($this->check_if_email_was_already_sent($data) == 0) {
                # Add entries to the db
                $this->create_entry_for_email($data);
                SendEmailNotificationsForSubscribers::dispatch($data);
            }
        }
    }
}
