<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'website_id',
        'user_id',
    ];


    public function post() : HasOne {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }


    public function website() : HasOne {
        return $this->hasOne(Website::class, 'id', 'website_id');
    }

    public function user() : HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}
