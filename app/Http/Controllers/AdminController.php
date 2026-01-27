<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function add_food(){
        return view('admin.add_food');
    }

    public function upload_food(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'img' => ['required', 'image', 'max:5120'],
        ]);

        $data = new Food();
        $data->title = $validated['title'];
        $data->detail = $validated['details'];
        $data->price = (string) $validated['price'];
        $data->image = $request->file('img')->store('food_img', 'public');
        $data->save();

        return redirect()->back()->with('message', 'Food added successfully.');
        
    }

    public function view_food(){
        $data = Food::query()->latest()->get();
        return view('admin.show_food', compact('data'));
    }
    public function delete_food($id){
        $food = Food::findOrFail($id);
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        return redirect()->back();
    }

    public function update_food($id){
        $food = Food::findOrFail($id);
        return view('admin.update_food', compact('food'));
    }

    public function edit_food(Request $request, $id){
        $food = Food::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $food->title = $validated['title'];
        $food->detail = $validated['detail'];
        $food->price = (string) $validated['price'];

        if($request->hasFile('image')){
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $filename = $request->file('image')->store('food_img','public');
            $food->image = $filename;
        }

        $food->save();
        return redirect('view_food');
    }
    public function orders(){
        $data = Order::query()->latest()->get();
        return view('admin.orders', compact('data'));
    }
    public function on_the_way($id){
        $order = Order::findOrFail($id);
        $order->delivery_status = Order::STATUS_ON_THE_WAY;
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'on_the_way', $recipientEmail));
                Log::info("Email sent to {$recipientEmail} for order {$id} status: on_the_way");
            } catch (\Exception $e) {
                Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }

        public function delivered($id){
        $order = Order::findOrFail($id);
        $order->delivery_status = Order::STATUS_DELIVERED;
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'delivered', $recipientEmail));
                Log::info("Email sent to {$recipientEmail} for order {$id} status: delivered");
            } catch (\Exception $e) {
                Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }

        public function canceled($id){
        $order = Order::findOrFail($id);
        $order->delivery_status = Order::STATUS_CANCELED;
        $order->save();

        // Send email notification
        $user = $order->user_id ? User::find($order->user_id) : null;
        $recipientEmail = $user ? $user->email : $order->email;
        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new OrderNotification(collect([$order]), $user, 'canceled', $recipientEmail));
                Log::info("Email sent to {$recipientEmail} for order {$id} status: canceled");
            } catch (\Exception $e) {
                Log::error("Failed to send email for order {$id}: " . $e->getMessage());
            }
        } else {
            Log::warning("No email found for order {$id}");
        }

        return redirect()->back();

    }
    public function accept_booking($id){
        $booking = Book::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        if ($booking->email) {
            try {
                Mail::to($booking->email)->send(new BookingNotification($booking, 'accepted'));
                Log::info("Email sent to {$booking->email} for booking {$id} status: accepted");
            } catch (\Exception $e) {
                Log::error("Failed to send email for booking {$id}: " . $e->getMessage());
            }
        }

        return redirect()->back();
    }

    public function reject_booking($id){
        $booking = Book::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        if ($booking->email) {
            try {
                Mail::to($booking->email)->send(new BookingNotification($booking, 'rejected'));
                Log::info("Email sent to {$booking->email} for booking {$id} status: rejected");
            } catch (\Exception $e) {
                Log::error("Failed to send email for booking {$id}: " . $e->getMessage());
            }
        }

        return redirect()->back();
    }
    public function reservation(){
       $book= Book::query()->latest()->get();
       return view('admin.reservation', compact('book'));
    }

}

