<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','category_id','location','date','time','price','description'];

    public function getRouteKeyName()
    {
        return'description';
    }
}
