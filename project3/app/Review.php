<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
