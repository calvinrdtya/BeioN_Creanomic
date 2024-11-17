<?php

namespace App\Http\Controllers\mitra;

use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = Mitra::latest();

        if(!empty($request->get('keyword'))) {
            $users = $users->where('name','like','%'.$request->get('keyword').'%');
            $users = $users->Where('email','like','%'.$request->get('keyword').'%');
            $users = $users->orWhere('role','like','%'.$request->get('keyword').'%');


        }

        $users = $users->paginate(10);

        return view('mitra.users.list',[
            'users' => $users
        ]);

    }

    public function create(Request $request) {
        return view('mitra.users.create',[
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ]);

        if ($validator->passes()) {

            $user = new Mitra;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();

            $message = 'User Added Successfully.';

            session()->flash('success', $message);


            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function edit (Request $request, $id) {
        $user = Mitra::find($id);

        if  ($user == null) {
            $message = 'User Not Found';
            session()->flash('error',$message);
            return redirect()->route('users.index');
        }

        return view ('mitra.users.edit',[
            'user' =>$user
        ]);
    }
    public function update(Request $request, $id) {

        $user = Mitra::find($id);

        if  ($user == null) {
            $message = 'User Not Found';
            session()->flash('error',$message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' => 'required',
        ]);

        if ($validator->passes()) {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;

            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }

            
            $user->save();

            $message = 'User Added Successfully.';

            session()->flash('success', $message);


            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id) {

        $user = Mitra::find($id);

        if  ($user == null) {
            $message = 'User Not Found';
            session()->flash('error',$message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $user->delete();

        $message = 'User Deleted Successfully';
            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

    public function export_excel(){
       return Excel::download(new ExportUser, "User.xlsx");
    }

}