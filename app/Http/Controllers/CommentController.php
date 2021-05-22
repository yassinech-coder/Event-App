<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Comment;
use App\Notifications\NewCommentPosted;
use App\Notifications\NewReplyAdded;
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

        $event->user->notify(new NewCommentPosted($event, auth()->user()));
        return redirect()->route('events.show', [$event->id, $event->title]);
    }

    public function storeCommentReply(Comment $comment, Event $event)
    {
        request()->validate([
            'replyComment' => 'required|min:3'
        ]);

        $commentReply = new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id = auth()->user()->id;

        $comment->comments()->save($commentReply);
        $comment->user->notify(new NewReplyAdded($comment, auth()->user(),$event));

        return redirect()->back();
    }
}