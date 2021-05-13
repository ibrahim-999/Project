<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Ticket;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use PharIo\Manifest\Email;
use Validator;

class TicketController extends Controller
{

    public function storeTicket()
    {
        $ticket = Ticket::get();
        $city = City::get();
        $category = Category::get();
        return response()->json(['ticket'=>$ticket,'city'=>$city,'category'=>$category],200);


    }
    public function createTicket(Request $request)
    {

        if($request->isMethod('post'))
        {
            $ticket = new Ticket();
            $userTicket = $request->input();

            $rules = [
                "name" => "required",
                "date_party"  => "required|date|after:today",
                "image"=>"image|mimes:jpeg,png",
                "age" => "required",
                "price_without_vat" => "required|numeric",
                "price" => "required|numeric",
                "vat" => "required|numeric",
                "hour_party" => "required|numeric",
                "qty" => "required|numeric",

            ];

            $customMessage = [
                "name.required" =>"Name is required" ,
                "date_party.required" => "Date is required",
                "date_party.date" => "Valid date is required",
                "date-party.after:today"=> "after today",
                "image.image" =>"Valid image required",
                "age.required" => "Age is required",
                "price_without_vat.required" => "Price  is required",
                "price.required" => "Price is required",
                "hour_party.required" => "Hour Party is required",
                "qty.required" => "Quantity is required",

            ];

            $validator = Validator::make($userTicket,$rules,$customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }


            if($request->hasFile('image'))
            {
                $image_temp = $request->file('image');
                if($image_temp->isValid()) {
                    //Get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/ticket_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $ticket->image = $imageName;
                }

            }

            if($request->hasFile('image2'))
            {
                $image_temp = $request->file('image2');
                if($image_temp->isValid()) {
                    //Get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/ticket_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $ticket->image2 = $imageName;
                }

            }

            if($request->hasFile('image3'))
            {
                $image_temp = $request->file('image3');
                if($image_temp->isValid()) {
                    //Get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/ticket_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $ticket->image3 = $imageName;
                }

            }

            if($request->hasFile('image4'))
            {
                $image_temp = $request->file('image4');
                if($image_temp->isValid()) {
                    //Get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/ticket_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $ticket->image4 = $imageName;
                }

            }

           /* if(empty($userTicket['name'])|| empty(['date_party'])|| empty(['image']))
            {
                $message = " Please complete ticket data";
                return response()->json(["status"=>false,'message'=>$message],442);
            }

            if(!filter_var($userTicket['date_party']), FILTER_VALIDATE_EMAIL)
            {
                $message = " Please complete ticket data";
                return response()->json(["status"=>false,'message'=>$message],442);
            }*/


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
            $ticket->save();
            return response()->json(['message'=>'Ticket has been booked'],201);
        }

    }

}
