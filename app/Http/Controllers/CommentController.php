<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Event $event)
    {
        request()->validate([
            'content' => 'required|min:5'
        ]);
        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;

        $event->comments()->save($comment);
        return redirect()->route('events.show', [$event->id, $event->title]);
    }
}