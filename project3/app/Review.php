<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply(array $reply)
    {
        $this->replies()->create($reply);
    }
}
