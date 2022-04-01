<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public $user;
    public $post;
    public $website;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->user = $data->user;
        $this->post = $data->post;
        $this->website = $data->website;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->markdown('mail.new-post-mail', [
            'user' => $this->data->user,
            'post' => $this->post,
            'website' => $this->website,
        ])->subject('[New Post] ' . $this->data->website->name);
    }
}
