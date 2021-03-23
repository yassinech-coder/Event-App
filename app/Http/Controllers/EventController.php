<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\EventCreateRequest;
use App\Models\Event;
use App\Http\Controllers\Auth ;
use Illuminate\Support\Facades\Storage;
use App\Http\UploadedFile;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;

class EventController extends Controller
{
      public function __construct()
      {
      $this->middleware('organizer',['except'=>array('index','show','participate','allEvents')]);
      }
    public function index()
    {
         $events=Event::latest()->limit(5)->get();        
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

       public function participate(Request $request,$id)
       {
            $eventId = Event::find($id);
            $eventId->users()->attach(auth()->user()->id);
            return redirect()->back()->with('message','Participated Successfully!');

       }

       public function participant()
       {
           $participants = Event::has('users')->where('user_id',auth()->user()->id)->get();
           return view('events.participants')->with(compact('participants'));
       }

       public function allEvents(Request $request)
       {
          $keyword = $request->get('title');
          $category = $request->get('category_id');
          $location = $request->get('location');
          $date = $request->get('date');

          if($keyword||$category||$location||$date)
          {
              $events = Event::where('title',$keyword)
              ->orWhere('category_id',$category)
              ->orWhere('location',$location)
              ->orWhere('date',$date)
              ->simplePaginate(5);
              return view ('events.allevents')->with(compact('events'));
           }else{
          $events = Event::latest()->simplePaginate(5);
          return view ('events.allevents')->with(compact('events'));
       }
     }
}

