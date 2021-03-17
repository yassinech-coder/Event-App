<?php

namespace App\Http\Controllers;
use App\Http\Requests\EventCreateRequest;
use App\Models\Event;
use App\Http\Controllers\Auth ;
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

    public function create()
    {
         return view('events.create');
    }

    public function store(EventCreateRequest $request)
    {
     $user_id = auth()->user()->id ;
       Event::create([
          'user_id'=> $user_id ,
          'title'=>request('title'),
          'category_id'=>request('category'),
          'location'=>request('location'),
          'date'=>request('date'),
          'time'=>request('time'),
          'price'=>request('price') ,
          'description'=>request('description'),
          
         ]);
        return redirect()->back()->with('message','Event Created Successfully !');
    }


}
