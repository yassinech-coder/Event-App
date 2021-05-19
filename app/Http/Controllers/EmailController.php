<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEvent;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
	public function send(Request $request)
	{
		$homeUrl = url('/');
		$eventId = $request->get('event_id');
		$eventTitle = $request->get('event_title');
		$eventUrl = $homeUrl . '/' . 'events/' . $eventId . '/' . $eventTitle;
		$data = array(
			'your_name' => $request->get('your_name'),

			'your_email' => $request->get('your_email'),

			'friend_name' => $request->get('friend_name'),
			'eventUrl' => $eventUrl
		);
		$emailTo = $request->get('friend_email');
		$emailsTo = explode(' ', $emailTo);
		foreach ($emailsTo as $email) {
			Mail::to($email)->send(new SendEvent($data));
		}
		return redirect()->back()->with('message', 'Event link sent to ' . $emailTo);
	}
}
