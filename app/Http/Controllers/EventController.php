<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\EventCreateRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use App\Http\UploadedFile;
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

    public function myevent()
    {
         $event = Event::where('user_id',auth()->user()->id )->get();
         return view('events.myevent')->with(compact('event'));
    }

    public function create()
    {
     $events = Event::where('user_id',auth()->user()->id )->get();
         return view('events.create');
    }

   
    public function store(EventCreateRequest $request)
    {
         $events = new event();
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
          'picture'=>request('picture'),
          ]); 
          Log::info('$picture');
        return redirect()->back()->with('message','Event Created Successfully !');
    }
   
    public function mypicture(Request $request) 
    {
     
     $user_id = auth()->user()->id ;    

      if($request->hasfile('picture')){
         $picture = $request->file('picture')->store('public/pictures');
        Event::create([
         'picture'=>$picture
          ]);
         
        }
    }

       public function edit($id)
       {
         $event = Event::findOrFail($id);
          return view('events.edit')->with(compact('event'));
       }

       public function update(Request $request,$id)
       {
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return redirect()->back()->with('message','Event Successfully Updated!');
       } 

}

