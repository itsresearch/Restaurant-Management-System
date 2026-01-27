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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

public function my_home(){

    $data = Food::query()->latest()->get();
    return view('home.index', compact('data'));
}
    //
    public function index(){
        if (! Auth::check()) {
            $data = Food::query()->latest()->get();
            return view('home.index', compact('data'));
        }

        $usertype = strtolower((string) (Auth::user()->usertype ?? 'user'));

        if ($usertype === 'user') {
            $data = Food::query()->latest()->get();
            return view('home.index', compact('data'));
        }

        $total_user = User::where('usertype', '=', 'user')->count();
        $total_food = Food::count();
        $total_order = Order::count();
        $total_delivered = Order::whereIn('delivery_status', ['delivered', 'Delivered'])->count();
        return view('admin.index', compact('total_user', 'total_food', 'total_order', 'total_delivered'));
    }

    public function add_cart(Request $request, $id){
        $validated = Validator::make($request->all(), [
            'qty' => ['required', 'integer', 'min:1', 'max:99'],
        ])->validate();

        if (Auth::id()){
            $food = Food::findOrFail($id);

            $cart_title = $food->title;
            $cart_details = $food->detail;
            $cart_price = (float) preg_replace('/[^0-9.]/', '', (string) $food->price);
            $cart_image = $food->image;

            $data = new Cart;
            $data->title = $cart_title;
            $data->details = $cart_details;
            $data->price = $cart_price * (int) $validated['qty'];
            $data->image = $cart_image;
            $data->quantity = (int) $validated['qty'];
            $data->user_id = Auth()->user()->id;



            $data->save();

            $cartCount = Cart::where('user_id', Auth()->user()->id)->sum('quantity');
            session(['cart_count' => $cartCount]);
           
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Item added to cart successfully!',
                    'cart_count' => $cartCount
                ]);
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
        $data = Cart::findOrFail($id);
        if ((int) $data->user_id !== (int) Auth::id()) {
            abort(403);
        }
        $userId = $data->user_id;
        $data->delete();
        
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        session(['cart_count' => $cartCount]);
        
        return redirect()->back();
    }


public function confirm_order(Request $request)
{
    $user = auth()->user();
    $userId = $user->id;

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:30'],
        'address' => ['required', 'string', 'max:500'],
    ]);

    $cartItems = Cart::where('user_id', $userId)->get();
    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('message', 'Your cart is empty.');
    }

    DB::beginTransaction();
    try {
        foreach ($cartItems as $cart) {
            $order = new Order();
            $order->name = $validated['name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->user_id = $userId;

            $order->title = $cart->title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->delivery_status = Order::STATUS_IN_PROGRESS;

            $order->save();

            $cart->delete();
        }
        DB::commit();
    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Order confirm failed: '.$e->getMessage());
        return redirect()->back()->with('message', 'Failed to place order. Please try again.');
    }

    try {
        Mail::to($user->email)->send(new OrderNotification($cartItems, $user));
    } catch (\Throwable $e) {
        Log::error('Order email failed: '.$e->getMessage());
    }

    session(['cart_count' => 0]);

    return view('home.order_success', ['orders' => $cartItems, 'user' => $user]);
}
 public function book_table(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'a_guest' => 'required|integer|min:1|max:20',
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

