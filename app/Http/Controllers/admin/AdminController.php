<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $orders = DB::table('orders')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.dashboard', array('orders' => $orders));
    }
    public function adminlogin(Request $req)
    {
        if ($req->post('login')) {
            $validator = Validator::make($req->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $user = DB::table('admin')
                    ->where('email', '=', $req->post('email'))
                    ->orWhere('username', '=', $req->post('email'))
                    ->get();
                if (Hash::check($req->post('password'), $user[0]->password)) {
                    $user = array(
                        'admin_id' => $user[0]->id,
                        'adminname' => $user[0]->username,
                        'email' => $user[0]->email,
                    );
                    session()->put('loggedin_admin', $user);
                    return redirect('/admin');
                } else {
                    return redirect()->back()->withErrors(['error' => 'Admin not found!']);
                }
            }
        }
    }
}
