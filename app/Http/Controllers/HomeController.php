<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderNotification;

class HomeController extends Controller
{

public function my_home(){

    $data = Food:: all();
    return view('home.index', compact('data'));
}
    //
    public function index(){
        if (Auth::id()){
            $usertype= Auth()->user()->usertype;

        if($usertype=='user'){
                $data = Food:: all();

            return view('home.index', compact('data'));
        }

        else {

        $total_user = User::where('usertype','=', 'user')->count();
        $total_food = Food::count();
        $total_order = Order::count();
        $total_delivered = Order::where('delivery_status','=','delivered')->count();
            return view('admin.index',compact('total_user','total_food','total_order','total_delivered'));
        }
        }
    }

    public function add_cart(Request $request, $id){
        if (Auth::id()){
            $food= Food::find($id);

            $cart_title = $food->title;
            $cart_details = $food->detail;
            $cart_price = Str::remove('$',$food->price);
            $cart_image = $food->image;

            $data = new Cart;
            $data->title = $cart_title;
            $data->details = $cart_details;
            $data->price = $cart_price * $request->qty;
            $data->image = $cart_image;
            $data->quantity = $request->qty;
            $data->user_id = Auth()->user()->id;



            $data->save();

           
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Item added to cart successfully!']);
            }

            return redirect('/#blog')->with('message', 'Item added to cart successfully!');
            }

        else{
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login first.']);
            }
            return redirect('login');
        }

    }

    public function my_cart() {
        $user_id = Auth()->user()->id;
        $data = Cart::where('user_id',"=", $user_id)->get();
        return view('home.my_cart',compact('data'));
    }

    public function remove_cart($id){
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }


public function confirm_order(Request $request)
{
    $user = auth()->user();
    $userId = $user->id;

    $cartItems = Cart::where('user_id', $userId)->get();

    Mail::to($user->email)->send(new OrderNotification($cartItems, $user));

    foreach ($cartItems as $cart) {
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->user_id = $userId;

        $order->title = $cart->title;
        $order->quantity = $cart->quantity;
        $order->price = $cart->price;
        $order->image = $cart->image;

        $order->save();

        $cart->delete(); 
    }

    return view('home.order_success', ['orders' => $cartItems, 'user' => $user]);
}
 public function book_table(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'a_guest' => 'required|integer|min:1|max:10',
        'time' => 'required',
        'date' => 'required|date|after:today',
    ]);

    if ($validator->fails()) {
        return redirect('/#blog')->withErrors($validator)->withInput();
    }

    try {
        $data = new Book;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->guest = $request->a_guest;
        $data->time = $request->time;
        $data->date = $request->date;
        $data->save();
        return redirect('/#blog')->with('success', 'Table booked successfully!');
        } 
        catch (\Exception $e) {
            return redirect('/#blog')->with('error', 'Something went wrong. Please try again.');
        }
}


}

