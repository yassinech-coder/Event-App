<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Comment extends Model
{
    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }
}
