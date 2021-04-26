<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Event extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','category_id','location','date','time','price','description','picture'];
 

    public function getRouteKeyName()
    {
        return'title';
    }
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
  
    public function checkParticipation()
    {
        return DB::table('event_user')->where('user_id',auth()->user()->id)->where('event_id',$this->id)->exists();
    }

    public function favourites(){
        return $this->belongsToMany(Event::class,'favourites','event_id','user_id')->withTimestamps();
    }
  
    public function checkFavourite()
    {
        return DB::table('favourites')->where('user_id',auth()->user()->id)->where('event_id',$this->id)->exists();
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }
}
