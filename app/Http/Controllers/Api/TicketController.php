<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function createTicket(Request $request)
    {

        if($request->isMethod('post'))
        {
            $userTicket = $request->input();
            $ticket = new  Ticket();
            $ticket->name = $userTicket['name'];
            $ticket->city_id = $userTicket['city_id'];
            $ticket->category_id = $userTicket['category_id'];
            $ticket->user_id = $userTicket['user_id'];
            $ticket->age = $userTicket['age'];
            $ticket->information = $userTicket['information'];
            $ticket->price_without_vat = $userTicket['price_without_vat'];
            $ticket->price = $userTicket['price'];
            $ticket->vat = $userTicket['vat'];
            $ticket->desc = $userTicket['desc'];
            $ticket->date_party = $userTicket['date_party'];
            $ticket->hour_party = $userTicket['hour_party'];
            $ticket->qty = $userTicket['qty'];
            $ticket->image = $userTicket['image'];
            $ticket->save();
            return response()->json(['message'=>'ticket Added Successfully!']);
        }

    }

}
