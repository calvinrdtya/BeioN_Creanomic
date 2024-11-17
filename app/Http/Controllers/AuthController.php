<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\Midtrans\CreateSnapTokenService;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Login';
        return view('front.account.auth-user.login', compact('title'));
    }

    public function register()
    {
        $title = 'Register';
        return view('front.account.auth-user.register', compact('title'));
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'confirmed',
                // 'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>])(?=.*[0-9]).*$/',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'User';
        $user->save();

        session()->flash('Berhasil', 'Register Anda Berhasil');

        return redirect()
            ->route('account.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);


        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($credentials)) {
            session(['user_role' => Auth::user()->role]);

            return redirect(session()->pull('url.intended', route('front.home')));
        }

        return redirect()->route('account.login')
            ->withErrors(['email' => 'Email atau Password salah.'])
            ->withInput();
    }

    public function profile()
    {
        $userId = Auth::user()->id;

        $countries = Country::orderBy('name', 'ASC')->get();

        $user = User::where('id', $userId)->first();

        $address = CustomerAddress::where('user_id', $userId)->first();

        return view('front.account.profile', [
            'user' => $user,
            'countries' => $countries,
            'address' => $address
        ]);
    }

    // public function updateProfile(Request $request)
    // {
    //     $userId = Auth::user()->id;
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,except,id',
    //         'phone' => 'required|numeric'
    //     ]);

    //     if ($validator->passes()) {
    //         $user = User::find($userId);
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->phone = $request->phone;
    //         $user->save();

    //         session()->flash('success', 'Profile Updated Successfully');

    //         return response()->json([
    //             'status' => true,
    //             'errors' => 'Profile Updated Successfully'
    //         ]);

    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }

    // public function updateAddress(Request $request)
    // {
    //     $userId = Auth::user()->id;

    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|min:5',
    //         'last_name' => 'required',
    //         'email' => 'required|email',
    //         'country_id' => 'required',
    //         'address' => 'required|min:30',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'zip' => 'required',
    //         'mobile' => 'required',
    //     ]);

    //     if ($validator->passes()) {

    //         CustomerAddress::updateOrCreate (
    //             ['user_id' => $userId],
    //             [
    //                 'user_id' => $userId,
    //                 'first_name' => $request->first_name,
    //                 'last_name' => $request->last_name,
    //                 'email' => $request->email,
    //                 'mobile' => $request->mobile,
    //                 'country_id' => $request->country_id,
    //                 'address' => $request->address,
    //                 'apartment' => $request->apartment,
    //                 'city' => $request->city,
    //                 'state' => $request->state,
    //                 'zip' => $request->zip,

    //             ]
    //         );

    //         session()->flash('success', 'Address Updated Successfully');

    //         return response()->json([
    //             'status' => true,
    //             'errors' => 'Profile Updated Successfully'
    //         ]);

    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }

    public function logout()
    {
        Auth::logout();
        // return redirect()->route('account.login') //baleklogin
        return redirect()->route('front.home') //homepage
            ->with('success', 'You Successfully Logged Out!');
    }

    // public function orders() {

    //     $user = Auth::user();

    //     $orders = Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();


    //     $data['orders'] = $orders;
    //     return view('front.account.order',$data);
    // }

    // public function orderDetail($id) {
    //     $data = [];
    //     $user = Auth::user();
    //     $order = Order::where('user_id', $user->id)->where('id', $id)->first();
    //     $data['order'] = $order;

    //     $orderItems = OrderItem::where('order_id', $id)->get();
    //     $data['orderItems'] = $orderItems;

    //     $orderItemsCount = OrderItem::where('order_id', $id)->count();
    //     $data['orderItemsCount'] = $orderItemsCount;

    //     $snapToken = $order->snap_token;
    //      if (is_null($snapToken)) {
    //          // If snap token is still NULL, generate snap token and save it to database

    //          $midtrans = new CreateSnapTokenService($order);
    //          $snapToken = $midtrans->getSnapToken();

    //          $order->snap_token = $snapToken;
    //          $order->save();
    //      }

    //     //dd($order, $snapToken);
    //     return view('front.account.order-detail', compact('data', 'snapToken'));

    // // Set your Merchant Server Key
    // \Midtrans\Config::$serverKey = 'SB-Mid-server-WRQZUH4nYcmYsxStz4MTbWSR';
    // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    // \Midtrans\Config::$isProduction = false;
    // // Set sanitization on (default)
    // \Midtrans\Config::$isSanitized = true;
    // // Set 3DS transaction for credit card to true
    // \Midtrans\Config::$is3ds = true;

    // $params = array(
    //     'transaction_details' => array(
    //         'order_id' => $order->id,
    //         'gross_amount' => $order->grand_total,
    //     ),
    //     'customer_details' => array(
    //         'first_name' => $order->first_name,
    //         'last_name' => $order->last_name,
    //         'email' => $order->email,
    //         'phone' => $order->mobile,
    //     ),
    // );

    // $snapToken = \Midtrans\Snap::getSnapToken($params);
    // //dd($params, $snapToken);
    // return view('front.account.order-detail', compact('data', 'snapToken'));
    // }

    // public function wishlist(){
    //     $wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
    //     $data = [];
    //     $data['wishlists'] = $wishlists;
    //     return view('front.account.wishlist',$data);
    // }

    // public function removeProductFromWishList(Request $request) {
    //     $wishlist = Wishlist::where('user_id',Auth::user()-> id)->where('product_id',$request->id)->first();

    //     if ($wishlist == null) {
    //         session()->flash('error','Product Alredy Removed.');
    //         return response()->json([
    //             'status' => true,
    //         ]);
    //     } else {
    //         Wishlist::where('user_id',Auth::user()-> id)->where('product_id',$request->id)->delete();
    //         session()->flash('success','Product Removed Successfully.');
    //         return response()->json([
    //             'status' => true,
    //         ]);

    //     }
    // }

    // public function generateInvoice($id)
    // {
    //     // Retrieve order details and customer information
    //     $data = [];
    //     $user = Auth::user();
    //     $userId = Auth::user()->id;
    //     $order = Order::where('user_id', $user->id)->where('id', $id)->first();
    //     $data['order'] = $order;

    //     $orderItems = OrderItem::where('order_id', $id)->get();
    //     $data['orderItems'] = $orderItems;

    //     $user = User::where('id', $userId)->first();
    //     $data['user'] = $user;

    //     $address = CustomerAddress::where('user_id', $userId)->first();
    //     $data['address'] = $address;

    //     // Generate the PDF
    //     $pdf = PDF::loadView('front.account.invoice', compact('data'));

    //     // Set options if needed (e.g., page size, orientation)
    //     $pdf->setPaper('A4', 'potrait');

    //     // Download the PDF with a specific filename
    //     return $pdf->stream('invoice.pdf');
    // }

    // public function showChangePasswordForm() {
    //     return view('front.account.change-password');
    // }

    // public function changePassword(Request $request) {
    //     $validator = Validator::make($request->all(),[
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:5',
    //         'confirm_password' => 'required|same:new_password',
    //     ]);

    //     if ($validator->passes()) {

    //         $user = User::select('id','password')->where('id',Auth::user()->id)->first();

    //         if(!Hash::check($request->old_password,$user->password)){

    //             session()->flash('error','Your old password is incorrect, please try again.');

    //             return response()->json([
    //                 'status' => true,
    //             ]);
    //         }

    //         User::where('id', $user->id)->update([
    //             'password' => Hash::make($request->new_password)
    //         ]);

    //         session()->flash('success','You have successfully changed your password');

    //         return response()->json([
    //             'status' => true,
    //         ]);

    //         //dd($user);

    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }

    // public function forgotPassword () {
    //     return view('front.account.forgot-password');
    // }

    // public function processForgotPassword(Request $request) {
    //     $validator = Validator::make($request->all(),[
    //         'email' => 'required|email|exists:users,email'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('front.forgotPassword')->withInput()->withErrors($validator);
    //     }

    //     $token = Str::random(60);

    //     \DB::table('password_reset_tokens')->where('email',$request->email)->delete();

    //     \DB::table('password_reset_tokens')->insert([
    //         'email' => $request->email,
    //         'token' => $token,
    //         'created_at' => now()
    //     ]);


    // // Send Email Disini

    //     $user = User::where('email', $request->email)->first();

    //     $formData = [
    //         'token' => $token,
    //         'user' => $user,
    //         'mailSubject' => 'You have requested to reset your password'
    //     ];

    //         Mail::to($request->email)->send(new ResetPasswordEmail($formData));

    //         return redirect()->route('front.forgotPassword')->with('success', 'Please check your inbox to reset your password.');
    // }

    // public function resetPassword ($token) {

    //     $tokenExist = \DB::table('password_reset_tokens')->where('token', $token)->first();

    //     if ($tokenExist == null) {
    //         return redirect()->route('front.forgotPassword')->with('error', 'Invalid Request');
    //     }

    //     return view('front.account.reset-password',[
    //         'token' => $token
    //     ]);
    // }

    // public function processResetPassword(Request $request) {
    //     $token = $request->token;

    //     $tokenObj = \DB::table('password_reset_tokens')->where('token', $token)->first();

    //     if ($tokenObj == null) {
    //         return redirect()->route('front.forgotPassword')->with('error', 'Invalid Request');
    //     }

    //     $user = User::where('email',$tokenObj->email)->first();

    //     $validator = Validator::make($request->all(),[
    //         'new_password' => 'required|min:5',
    //         'confirm_password' => 'required|same:new_password'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('front.resetPassword',$token)->withErrors($validator);
    //     }

    //     User::where('id', $user->id)->update([
    //         'password' => Hash::make($request->new_password)
    //     ]);

    //     \DB::table('password_reset_tokens')->where('email',$request->email)->delete();

    //     return redirect()->route('account.login')->with('success','You have successfully updated your password.');
    // }
}
