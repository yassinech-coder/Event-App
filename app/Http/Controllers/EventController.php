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
use App\Models\Category;
class EventController extends Controller
{
      public function __construct()
      {
      $this->middleware('organizer',['except'=>array('index','show','participate','allEvents','searchEvents')]);
      }
    public function index()
    {
         $events=Event::latest()->limit(5)->get();  
         $categories = Category::with('events')->get();
         return view('welcome')->with(compact('events','categories'));
         
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
    
      if($request->hasfile('picture')){
          $file = $request->file('picture');
          $ext = $file->getClientOriginalExtension();
          $filename = time().'.'.$ext;
          $file->storeAs('articles',$filename, 'public');
          
        }  
       Event::create([
          'user_id'=> $user_id ,
          'title'=>request('title'),
          'category_id'=>request('category'),
          'location'=>request('location'),
          'date'=>request('date'),
          'time'=>request('time'),
          'price'=>request('price') ,
          'description'=>request('description'),
          'picture'=>$filename,
          ]); 
          Log::info('ppp');
        return redirect()->back()->with('message','Event Created Successfully !');
    }
   
   

       public function edit($id)
       {
         $event = Event::findOrFail($id);
          return view('events.edit')->with(compact('event'));
       }

       public function update(Request $request,$id)
       {
        $event = Event::findOrFail($id);
        $event->update($request->except('picture'));
       
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
          $title = $request->get('title');
          $category = $request->input('category_id');
          $location = $request->get('location');
          $date = $request->get('date');
          Log::info('msg');
        Log::info($category);
          if($title||$category||$location||$date)
          {
              $events = Event::where('title',$title)
              ->orWhere('category_id',$category)
              ->orWhere('location',$location)
              ->orWhere('date',$date)
              ->simplePaginate(5);
              Log::info($events);

              return view ('events.allevents')->with(compact('events'));
           }else{
          $events = Event::latest()->simplePaginate(5);
          return view ('events.allevents')->with(compact('events'));
           }
 
           }
     public function delete($id)
     {
      $event = Event::findOrFail($id);
      $event->delete();
      return redirect()->back()->with('message','Event Deleted!');
     } 
     public function searchEvents(Request $request)
     {
          $keyword = $request->get('keyword');
          Log::info($keyword);
          $users = Event::where('title','LIKE',"%{$keyword}%")
                  ->orWhere('location','LIKE',"%{$keyword}%")
                  ->limit(5)->get();
          return response()->json($users);
  
    
     }

}

