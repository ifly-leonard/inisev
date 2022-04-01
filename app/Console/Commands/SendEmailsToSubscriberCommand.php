<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Jobs\SendEmailNotificationsForSubscribers;

class SendEmailsToSubscriberCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendposts {company=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the latest posts of a company to all it\'s subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $company = $this->argument('company');
        if($company == 'null') {
            $this->error('You must pass the company ID. Use ' . route('api.v1.getdata.websites').' to get the ID');
        } else {

            $website = Website::find($company);

            $all_subscribers = Subscription::where('website_id', $website->id)->get();
            $post = Post::latest()->get();

            $this->info('Attempting to send the latest post of '. $website->name.' ('.$website->url.') to ' . count($all_subscribers));

            foreach($all_subscribers as $subscribers) {

                # Queue e-mail notifications to all of them.

                $data = (object) [
                    'user' => $subscribers->user,
                    'post' => $post,
                    'website' => $website,
                ];


                SendEmailNotificationsForSubscribers::dispatch($data);

                $this->line('Email dispatched for ' . $subscribers->user->email);
            }

            $this->info('Emails queued successfully! The will be sent out soon by the Queue');
        }


        return;
    }
}
