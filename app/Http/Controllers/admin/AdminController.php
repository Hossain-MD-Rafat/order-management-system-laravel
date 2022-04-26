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
            ->paginate(12);
        return view('admin.dashboard', array('orders' => $orders));
    }

    public function orderedit($id)
    {
        $loggedadmin = session('loggedin_admin');
        $order = DB::select("SELECT o.id as id, o.date, o.total_amount, o.delivery_status, o.total_amount, o.total_quantity, o.shipping, o.agent_fee, p.id as pid, p.name, p.unit_price, p.image, p.description, p.admin_image, p.quantity, p.color, p.size, p.product_url, a.name AS address_name, a.province, a.town, a.district, a.region, a.address, a.address_2, a.post_code, a.phone
        FROM orders AS o
        JOIN products AS p ON o.id=p.order_id
        JOIN address a ON a.id=o.address_id WHERE p.order_id={$id}");
        return view('admin.orderedit', ['order' => $order]);
    }
    public function updatestatus(Request $req)
    {
        if ($req->post('status_change')) {
            $affected = DB::table('orders')
                ->where('id', $req->order_id)
                ->update(['delivery_status' => $req->status]);
            if ($affected > 0) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        }
    }
    public function saveitem($oid, $pid, Request $req)
    {
        if ($req->post('item_save')) {
            $validator = Validator::make($req->all(), [
                'uploaded_images.*' => 'image|max:12000',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                if ($req->hasFile('uploaded_images') || $req->post('description')) {
                    $images = '';
                    foreach ($req->file('uploaded_images') as $key => $item) {
                        $path = $req->file('uploaded_images')[$key]->store('public/uploadedimage/' . $oid);
                        $path = str_replace("public/", "", $path);
                        if ($images) {
                            $images = $images . ';' . $path;
                        } else {
                            $images = $path;
                        }
                    }
                    $data = array(
                        'description' => $req->post('description'),
                        'admin_image' => $images
                    );
                    $res = DB::table('products')
                        ->where('id', '=', $pid)
                        ->update($data);
                    return redirect('admin/orderedit/' . $oid);
                }
            }
        }
    }
    public function ordersave($id, Request $req)
    {
        if ($req->post('order_save')) {
            $validator = Validator::make($req->all(), [
                'shipping_charge' => 'required',
                'agent_fee' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $data = array(
                    'shipping' => $req->post('shipping_charge'),
                    'agent_fee' => $req->post('agent_fee')
                );
                $res = DB::table('orders')
                    ->where('id', '=', $id)
                    ->update($data);
                return redirect('admin/orderedit/' . $id);
            }
        }
    }
    public function changeadminpass(Request $req)
    {
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
                    $loggedadmin = session('loggedin_admin');
                    $admin = DB::table('admin')
                        ->where('id', '=', $loggedadmin['admin_id'])
                        ->get();
                    if (Hash::check($req->post('password'), $admin[0]->password)) {
                        $res = DB::table('admin')
                            ->where('id', '=', $loggedadmin['admin_id'])
                            ->update(['password' => bcrypt($req->post('new_password'))]);
                        if ($res > 0) {
                            return redirect()->back()->with('msg', 'Your password has been changed successfully!');
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
    public function deleteorder(Request $req)
    {
        if ($req->post('delete') && !is_null(session('loggedin_admin'))) {
            $pd = DB::table('products')
                ->where('order_id', '=', $req->post('id'))
                ->delete();
            $deleted = DB::table('orders')
                ->where('id', '=', $req->post('id'))
                ->delete();
            if ($deleted) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        }
    }
    public function signout()
    {
        session()->forget('loggedin_admin');
        return redirect('admin');
    }
}
