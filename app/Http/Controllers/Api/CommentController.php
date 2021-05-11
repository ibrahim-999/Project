<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {

        if($request->isMethod('post'))
        {
            $userdata = $request->all();
            $comment = new  Comment();
            $comment->user_id =$userdata['user_id'];
            $comment->ticket_id = $userdata['ticket_id'];
            $comment->comment = $userdata['comment'];
            $comment->save();
            return response()->json(['message'=>'Category Added Successfully!']);
        }



    }
}
