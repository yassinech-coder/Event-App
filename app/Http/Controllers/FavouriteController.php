<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function addEvent($id) {
        $eventId = Event::find($id);
        $eventId-> favourites()->attach(auth()->user()->id);
        return redirect()->back();        
    }

    public function removeEvent($id)
    {
        $eventId = Event::find($id);
        $eventId->favourites()->detach(auth()->user()->id);
        return redirect()->back();
    }

}
