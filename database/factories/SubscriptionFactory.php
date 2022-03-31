<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
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

            $check = Subscription::where('user_id', $user->id)->where('website_id', $website->id)->count();
        } while($check != 0);


        return [
            'user_id' => $user->id,
            'website_id' => $website->id,
        ];
    }
}
