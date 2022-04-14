<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfile extends Controller
{
    public function profile($id = null)
    {
        return view('user.profile');
    }
    public function changeaccountinfo(Request $req)
    {
        if ($req->post('phone_change')) {
            $validator = Validator::make($req->all(), [
                'password' => 'required|min:6',
                'new_phone' => 'required|min:5',
                'new_phone_again' => 'required|min:5',
            ]);
            if ($req->post('new_phone') == $req->post('new_phone_again')) {
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors($errors);
                } else {
                    $loggeduser = session('loggedin_user');
                    $user = DB::table('users')
                        ->where('id', '=', $loggeduser['user_id'])
                        ->get();
                    if (Hash::check($req->post('password'), $user[0]->password)) {
                        $res = DB::table('users')
                            ->where('id', '=', $loggeduser['user_id'])
                            ->update(['phone' => $req->post('new_phone')]);
                        if ($res > 0) {
                            return redirect('/user');
                        } else {
                            return redirect()->back()->withErrors(['error' => 'Internal server error. Try again later']);
                        }
                    } else {
                        return redirect()->back()->withErrors(['error' => 'Password is incorrect!']);
                    }
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Both the phone number should be same']);
            }
        }
        if ($req->post('password_change')) {
            $validator = Validator::make($req->all(), [
                'password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'new_password_again' => 'required|min:6',
            ]);
            if ($req->post('new_password') == $req->post('new_password_again')) {
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors($errors);
                } else {
                    $loggeduser = session('loggedin_user');
                    $user = DB::table('users')
                        ->where('id', '=', $loggeduser['user_id'])
                        ->get();
                    if (Hash::check($req->post('password'), $user[0]->password)) {
                        $res = DB::table('users')
                            ->where('id', '=', $loggeduser['user_id'])
                            ->update(['password' => bcrypt($req->post('new_password'))]);
                        if ($res > 0) {
                            return redirect('/user');
                        } else {
                            return redirect()->back()->withErrors(['error' => 'Internal server error. Try again later']);
                        }
                    } else {
                        return redirect()->back()->withErrors(['error' => 'Password is incorrect!']);
                    }
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Both the password should be same']);
            }
        }
    }
    public function address()
    {
        $loggeduser = session('loggedin_user');
        $addresses = DB::table('address')
            ->where('user_id', '=', $loggeduser['user_id'])
            ->get();
        return view('user.address', array('addresses' => $addresses));
    }
    public function addressform($id = null)
    {
        if (!is_null($id)) {

        }
        return view('user.addressform', ['data' => ])
    }
    public function addaddress(Request $req)
    {
        if ($req->post('save_address')) {
            $validator = Validator::make($req->all(), [
                'name' => 'required|min:2',
                'province' => 'required',
                'town' => 'required',
                'district' => 'required',
                'address' => 'required',
                'region' => 'required',
                'post_code' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $loggeduser = session('loggedin_user');
                $data = array(
                    'user_id' => $loggeduser['user_id'],
                    'name' => $req->post('name'),
                    'province' => $req->post('province'),
                    'town' => $req->post('town'),
                    'district' => $req->post('district'),
                    'region' => $req->post('region'),
                    'address' => $req->post('address'),
                    'address_2' => $req->post('address_2'),
                    'post_code' => $req->post('post_code'),
                    'phone' => $req->post('phone'),
                );
                $res = DB::table('address')->insert($data);
                if ($res > 0) {
                    return redirect('user/addresses');
                } else {
                    return redirect()->back()->withErrors(['error' => 'Unable to save address now. Please try later']);
                }
            }
        }
    }
}
