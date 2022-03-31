<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use App\Models\EmailLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

         # Since brief had mentioned "NO DUPLICATES"

         do {
            $user = User::inRandomOrder()->first();
            $website = Website::inRandomOrder()->first();
            $post = Post::inRandomOrder()->first();

            $check = EmailLog::where('user_id', $user->id)
            ->where('website_id', $website->id)
            ->where('post_id', $post->id)
            ->count();
        } while($check != 0);


        return [
            'user_id' => $user->id,
            'website_id' => $website->id,
            'post_id' => $post->id,
        ];


    }
}
