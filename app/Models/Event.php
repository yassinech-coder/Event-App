<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','category_id','location','date','time','price','description','picture'];
 

    public function getRouteKeyName()
    {
        return'description';
    }
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
  
    public function checkParticipation()
    {
        return DB::table('event_user')->where('user_id',auth()->user()->id)->where('event_id',$this->id)->exists();
    }
}
