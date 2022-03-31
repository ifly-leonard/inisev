<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'website_id',
    ];

    public function user() : HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function website() : HasOne {
        return $this->hasOne(Website::class, 'id', 'website_id');
    }
}
