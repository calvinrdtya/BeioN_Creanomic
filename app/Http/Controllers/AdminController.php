<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Mitra;
use App\Models\User;

class AdminController extends Controller
{
    public function index() 
    {
        $title = "Login";
        return view('admin.login', compact('title'));
    }

    public function home()
    {
        $title = "Dashboard";

        // Menghitung jumlah mitra
        $mitra = [
            'perjalanan' => Mitra::where('jenis', 'perjalanan')->count(),
            'motor' => Mitra::where('jenis', 'transportasi motor')->count(),
            'mobil' => Mitra::where('jenis', 'transportasi mobil')->count(),
            'perlengkapan' => Mitra::where('jenis', 'perlengkapan')->count(),
            'homestay' => Mitra::where('jenis', 'homestay')->count(),
        ];

        // Menghitung jumlah user
        $user = User::count();

        return view('admin.dashboard', compact('title', 'mitra', 'user'));
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                
                $admin = Auth::guard('admin')->user();

                if ($admin->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You Are Not Authorized to Access Admin Panel.');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Either Email/Password is Incorrect');
            }
        } else {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function overview()
    {
        return view('admin.all-mitra.overview');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
