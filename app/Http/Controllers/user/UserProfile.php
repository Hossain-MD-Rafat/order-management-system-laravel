<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfile extends Controller
{
    public function profile()
    {
        $loggeduser = session('loggedin_user');
        $address = DB::table('address')
            ->where('user_id', '=', $loggeduser['user_id'])
            ->where('status', '=', 1)
            ->get();
        $orders = DB::select("SELECT o.id, o.date, p.unit_price, o.delivery_status, p.image FROM orders AS o JOIN products AS p ON o.id=p.order_id WHERE o.user_id={$loggeduser['user_id']}");
        return view('user.profile', array('address' => $address, 'orders' => $orders));
    }
    public function profiledetails()
    {
        $loggeduser = session('loggedin_user');
        $details = DB::table('users')
            ->where('id', '=', $loggeduser['user_id'])
            ->get();
        return view('user.profiledetails', array('details' => $details[0]));
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
            ->where('status', '=', 0)
            ->get();
        return view('user.address', array('addresses' => $addresses));
    }
    public function addressform($id = null)
    {
        $address = [];
        if (!is_null($id)) {
            $address = DB::table('address')
                ->where('id', '=', $id)
                ->get();
        }
        return view('user.addressform', ['address' => $address]);
    }
    public function addaddress(Request $req)
    {
        if ($req->post('save_address') || $req->post('save_profile')) {
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
                $res = -1;
                if ($req->post('save_profile')) {
                    $data['status'] = 1;
                }
                if ($req->post('id')) {
                    $res = DB::table('address')
                        ->where('id', '=', $req->post('id'))
                        ->update($data);
                } else {
                    $res = DB::table('address')->insert($data);
                }
                if ($res >= 0) {
                    return redirect('user/address');
                } else {
                    return redirect()->back()->withErrors(['error' => 'Unable to save address now. Please try later']);
                }
            }
        }
    }
    public function addressdelete(Request $req)
    {
        if ($req->post('delete')) {
            $loggeduser = session('loggedin_user');
            $deleted = DB::table('address')
                ->where('id', '=', $req->post('id'))
                ->where('user_id', '=', $loggeduser['user_id'])
                ->delete();
            if ($deleted) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        }
    }
    public function shipping()
    {
        $loggeduser = session('loggedin_user');
        $address = DB::table('address')
            ->where('user_id', '=', $loggeduser['user_id'])
            ->where('status', '=', 0)
            ->get();
        $mainAddress = DB::table('address')
            ->where('user_id', '=', $loggeduser['user_id'])
            ->where('status', '=', 1)
            ->get('id');
        return view('user.shippingaddress', array('address' => $address, 'main' => $mainAddress));
    }
    public function addshipping(Request $req)
    {
        if ($req->post('place_order')) {
            $validator = Validator::make($req->all(), [
                'address_id' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $loggeduser = session('loggedin_user');
                $total = 0;
                $itemsCount = sizeof(session('cart'));
                $totalQuantity = 0;
                foreach (session('cart') as $item) {
                    $total += $item['price'];
                    $totalQuantity += $item['quantity'];
                }
                $orderData = array(
                    'user_id' => $loggeduser['user_id'],
                    'total_amount' => $total,
                    'items_count' => $itemsCount,
                    'total_quantity' => $totalQuantity
                );
                $order_id = DB::table('orders')->insertGetId($orderData);
                foreach (session('cart') as $key => $item) {
                    $productData = array(
                        'name' => $item['title'],
                        'product_url' => $item['url'],
                        'image' => $item['banner'],
                        'order_id' => $order_id,
                        'unit_price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'color' => $item['color'],
                        'size' => $item['size']
                    );
                    $res = DB::table('products')->insert($productData);
                    if ($res < 1) {
                        return redirect()->back()->withErrors(['error' => 'Unable to complete order. Please try again.']);
                    }
                }
                session()->forget('cart');
                return redirect('user');
            }
        }
    }
    public function order($id)
    {
        $loggeduser = session('loggedin_user');
        $order = DB::select("SELECT o.id, o.date, o.total_amount, o.delivery_status, o.total_amount, o.total_quantity, p.name, p.unit_price, p.image, p.description, p.admin_image, p.quantity, p.color, p.size FROM orders AS o JOIN products AS p ON o.id=p.order_id WHERE o.user_id={$loggeduser['user_id']} and p.order_id={$id}");
        return view('user.order', ['order' => $order]);
    }
    public function signout()
    {
        session()->forget('loggedin_user');
        return redirect('user');
    }
    // public function cart()
    // {
    //     print_r(sizeof(session('cart')));
    //     print_r(session('cart'));
    // }
}
