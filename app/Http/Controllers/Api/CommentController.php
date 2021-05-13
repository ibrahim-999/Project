<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {

        if($request->isMethod('post'))
        {
            $commentdata = $request->input();
            $comment = new  Comment();
            $comment->user_id =$commentdata['user_id'];
            $comment->ticket_id = $commentdata['ticket_id'];
            $comment->comment = $commentdata['comment'];
            $comment->active = $commentdata['active'];
            $comment->save();
            return response()->json(['message'=>'Comment has been Added Successfully!'],201);
        }

    }
}
