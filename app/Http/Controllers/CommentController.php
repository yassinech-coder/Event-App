<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Comment;
use App\Notifications\NewCommentPosted;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
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

        auth()->user()->notify(new NewCommentPosted($event, auth()->user()));
        return redirect()->route('events.show', [$event->id, $event->title]);
    }

    public function storeCommentReply(Comment $comment)
    {
        request()->validate([
            'replyComment' => 'required|min:3'
        ]);

        $commentReply = new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id = auth()->user()->id;

        $comment->comments()->save($commentReply);

        return redirect()->back();
    }
}