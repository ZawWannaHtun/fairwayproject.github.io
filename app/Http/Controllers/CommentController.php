<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $comment = new comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }

    public function delete($id)
    {
        $comment = comment::find($id);

        if(Gate::allows("comment-delete", $comment)){
            $comment->delete();
            return back()->with("info", "A comment deleted");
        }
            return back()->with("error", "Unauthorize to delete");

    }

}
