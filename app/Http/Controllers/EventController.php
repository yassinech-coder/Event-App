<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
         $events=Event::all()->take(5);        
         return view('welcome')->with(compact('events'));
    }
    public function show($id, Event $event)
    {   
       
         return view('events.show')->with(compact('event'));
    }
}
