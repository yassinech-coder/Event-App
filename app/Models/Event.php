<?php

namespace App\Models;

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
    public function user(){
        return $this->belongsTo(User::class);
    }

}
