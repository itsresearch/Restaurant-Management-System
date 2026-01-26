<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;

class AdminController extends Controller
{
    //
    public function add_food(){
        return view('admin.add_food');
    }

    public function upload_food(Request $request){
        $data = new Food;
        $data->title = $request->title;
        $data->detail = $request->details;
        $data->price = $request->price;
        $image = $request->img;
        $filename = $request->file('img')->store('food_img','public');
        $data->image = $filename;
        $data -> save();
        return redirect()->back();
        
    }

    public function view_food(){
        $data = Food::all();
        return view('admin.show_food', compact('data'));
    }
    public function delete_food($id){
        $data = Food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update_food($id){
        $food = Food::find($id);
        return view('admin.update_food', compact('food'));
    }

    public function edit_food(Request $request, $id){
        $food = Food::find($id);
        $food->title = $request->title;
        $food->detail = $request->detail;
        $food->price = $request->price;

        if($request->hasFile('image')){
            $filename = $request->file('image')->store('food_img','public');
            $food->image = $filename;
        }

        $food->save();
        return redirect('view_food');
    }
    public function orders(){
        $data = Order::all();
        return view('admin.orders', compact('data'));
    }
    public function on_the_way($id){
        $order = Order::find($id);
        $order->delivery_status = "On the way";
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'on_the_way', $recipientEmail));
                \Log::info("Email sent to {$recipientEmail} for order {$id} status: on_the_way");
            } catch (\Exception $e) {
                \Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            \Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }

        public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status = "Delivered";
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'delivered', $recipientEmail));
                \Log::info("Email sent to {$recipientEmail} for order {$id} status: delivered");
            } catch (\Exception $e) {
                \Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            \Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }

        public function canceled($id){
        $order = Order::find($id);
        $order->delivery_status = "Canceled";
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'canceled', $recipientEmail));
                \Log::info("Email sent to {$recipientEmail} for order {$id} status: canceled");
            } catch (\Exception $e) {
                \Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            \Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }
    public function reservation(Request $request){
       $book= Book::all();
       return view('admin.reservation', compact('book'));
    }

}

