<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\EventCreateRequest;
use App\Models\Event;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\UploadedFile;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Mail\ParticipateEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
     public function __construct()
     {
          $this->middleware('organizer', ['except' => array('index', 'show', 'participate', 'allEvents', 'searchEvents','showFromNotification')]);
     }
     public function index()
     {
          $events = Event::latest()->limit(5)->get();
          $categories = Category::with('events')->get();
          return view('welcome')->with(compact('events', 'categories'));
     }

     public function show($id, Event $event)
     {
          $data = [];
          $eventBasedOnLocation = Event::latest()->where('location', 'LIKE', '%' . $event->location . '%')
               ->whereDate('date', '>', date('Y-m-d'))
               ->where('id', '!=', $event->id)
               ->limit(3)
               ->get();
          array_push($data, $eventBasedOnLocation);

          $eventBasedOnCategories = Event::latest()
               ->where('category_id', $event->category_id)
               ->whereDate('date', '>', date('Y-m-d'))
               ->where('id', '!=', $event->id)
               ->limit(3)
               ->get();
          array_push($data, $eventBasedOnCategories);
          $collection = collect($data);
          $unique = $collection->unique('id');
          $eventRecommendations = $unique->values()->first();



          return view('events.show')->with(compact('event', 'eventRecommendations'));
     }

     public function myevent()
     {
          $events = Event::where('user_id', auth()->user()->id)->get();
          return view('events.myevent')->with(compact('events'));
     }

     public function create()
     {
          $events = Event::where('user_id', auth()->user()->id)->get();
          return view('events.create');
     }


     public function store(EventCreateRequest $request)
     {
          $events = new event();
          $user_id = auth()->user()->id;

          if ($request->hasfile('picture')) {
               $file = $request->file('picture');
               $ext = $file->getClientOriginalExtension();
               $filename = time() . '.' . $ext;
               $file->storeAs('articles', $filename, 'public');
          }
          Event::create([
               'user_id' => $user_id,
               'title' => request('title'),
               'category_id' => request('category'),
               'location' => request('location'),
               'date' => request('date'),
               'time' => request('time'),
               'price' => request('price'),
               'seats' => request('seats'),
               'description' => request('description'),
               'picture' => $filename,
          ]);

          return redirect()->back()->with('message', 'Event Created Successfully !');
     }



     public function edit($id)
     {
          $event = Event::findOrFail($id);
          return view('events.edit')->with(compact('event'));
     }

     public function update(Request $request, $id)
     {
          $event = Event::findOrFail($id);
          $event->update($request->except('picture'));

          return redirect()->back()->with('message', 'Event Successfully Updated!');
     }

     public function participate(Request $request, $id)
     {
          $eventId = Event::find($id);
          $eventId->users()->attach(auth()->user()->id);

          $homeUrl = url('/');
          $eventId = $request->get('event_id');
          $eventTitle = $request->get('event_title');

          $eventUrl = $homeUrl . '/' . 'events/' . $eventId . '/' . $eventTitle;
          $eventUser = DB::table('event_user')->where('event_id', $eventId)->where('user_id', auth()->user()->id)->first();
          $code = 'Y20S7'. strval($eventUser->event_id) . strval($eventUser->user_id);
          $data = array(

               'friend_name' => $request->get('friend_name'),
               'eventUrl' => $eventUrl,
               'event_title' => $eventTitle,
               'code' => $code,

          );

          $event = Event::find($id);
          $event->seats--;
          $event->save();
          $emailTo = $request->get('friend_email');

          Mail::to($emailTo)->send(new ParticipateEvent($data));

          return redirect()->back()->with('message', 'Participated! , Check Your Email ' . $emailTo);
     }

     public function participant()
     {
          $participants = Event::has('users')->where('user_id', auth()->user()->id)->get();
          return view('events.participants')->with(compact('participants'));
     }

     public function allEvents(Request $request)
     {
          $title = $request->get('title');
          $location = $request->get('location');

          if ($title && $location) {
               $events = Event::where('title', 'LIKE', '%' . $title . '%')
                    ->orWhere('location', 'LIKE', '%' . $location . '%')
                    ->paginate(5);
               return view('events.allevents')->with(compact('events'));
          }

          $title = $request->get('title');
          $category = $request->input('category_id');
          $location = $request->get('location');
          $date = $request->get('date');

          if ($title || $category || $location || $date) {
               $events = Event::where('title', $title)
                    ->orWhere('category_id', $category)
                    ->orWhere('location', $location)
                    ->orWhere('date', $date)
                    ->simplePaginate(5);


               return view('events.allevents')->with(compact('events'));
          } else {
               $events = Event::latest()->simplePaginate(5);
               return view('events.allevents')->with(compact('events'));
          }
     }
     public function delete($id)
     {
          $event = Event::findOrFail($id);
          $event->delete();
          return redirect()->back()->with('message', 'Event Deleted!');
     }
     public function searchEvents(Request $request)
     {
          $keyword = $request->get('keyword');
          $users = Event::where('title', 'LIKE', "%{$keyword}%")
               ->orWhere('location', 'LIKE', "%{$keyword}%")
               ->limit(5)->get();
          return response()->json($users);
     }

     public function showFromNotification($id, Event $event, DatabaseNotification $notification)
     {
          $notification->markAsRead();
          return $this->show($id, $event);
     }
}
