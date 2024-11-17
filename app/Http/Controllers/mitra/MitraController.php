<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Mitra;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class MitraController extends Controller
{
    public function index()
    {
        $title = 'Login Mitra';
        return view('front.account.auth-mitra.login', compact('title'));
    }

    public function register()
    {
        $title = 'Register Mitra';
        return view('front.account.auth-mitra.register', compact('title'));
    }

    public function process_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => [
                'required',
                'string',
                'min:8'
                // 'max:12',
                // 'confirmed',
                // 'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~])(?=.*[0-9]).*$/'
            ],
            'jenis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mitra = new Mitra;
        $mitra->name = $request->name;
        $mitra->email = $request->email;
        $mitra->phone = $request->phone;
        $mitra->password = Hash::make($request->password);
        $mitra->role = 'mitra';
        $mitra->jenis = $request->jenis;
        $mitra->save();

        session()->flash('success', 'Pembuatan Akunmu Berhasil');
        return redirect()->route('mitra.login');
    }


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::guard('mitra')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                $mitra = Auth::guard('mitra')->user();
                if ($mitra->role == 'mitra') {
                    Session::put('mitra_id', $mitra->id);
                    if (isset($mitra->jenis)) {
                        Session::put('jenis', $mitra->jenis);
                        Log::info('Mitra jenis set to session: ' . $mitra->jenis);
                    } else {
                        Log::error('Mitra jenis is not set or null');
                        return redirect()->route('mitra.login')->with('error', 'User does not have a jenis assigned.');
                    }
                    return redirect()->route('mitra.dashboard');
                } else {
                    Auth::guard('mitra')->logout();
                    return redirect()->route('mitra.login')->with('error', 'You Are Not Authorized to Access Mitra Panel.');
                }
            } else {
                return redirect()->route('mitra.login')->with('error', 'Either Email/Password is Incorrect');
            }
        } else {
            return redirect()->route('mitra.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function account()
    {
        $title = 'Akun';

        $mitra = auth()->guard('mitra')->user();
        return view('mitra.data.homestay.setting.index', compact('mitra', 'title'));
    }

    public function updateAccount(Request $request)
    {
        $mitra = auth()->guard('mitra')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mitras,email,' . $mitra->id,
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'identitas_type' => 'required|string|max:255',
            'legalitas_type' => 'required|string|max:255',
            'legalitas_lainnya' => 'nullable|string|max:255',
            'identitas_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'legalitas_file' => 'nullable|file|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $identitas = [
            'type' => $request->identitas_type,
            'img' => null,
        ];
        $legalitas = [
            'type' => $request->legalitas_type,
            'file' => null,
        ];
        
        if ($request->hasFile('identitas_photo')) {
            $path = $request->file('identitas_photo')->store('identitas', 'public');
            $identitas['img'] = $path;
        }
        
        if ($request->legalitas_type != 'Belum Ada' && $request->hasFile('legalitas_file')) {
            $path = $request->file('legalitas_file')->store('legalitas', 'public');
            $legalitas['file'] = $path;
        } elseif ($request->legalitas_type == 'Lainnya') {
            $legalitas['type'] = $request->legalitas_lainnya;
        }
        
        $mitra->update([
            'name' => $request->name,
            'owner' => $request->owner,
            'pic' => $request->pic,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'identitas' => $identitas,
            'legal' => $legalitas,
        ]);        

        return redirect()->route('mitra.account')->with('success', 'Data mitra berhasil diperbarui.');
    }
}
