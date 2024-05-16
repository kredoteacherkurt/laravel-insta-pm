<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function store(Request $request) {


        $this->comment->body = $request->body;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $request->post_id;
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
