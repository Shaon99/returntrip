<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function  follower_post()
    {
        return $this->hasMany(FollowPerson::class,'follow_person_id','user_id');
    }
}
