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
        $order = DB::select("SELECT o.id as id, o.date, o.total_amount, o.delivery_status, o.total_amount, o.total_quantity, p.id as pid, p.name, p.unit_price, p.image, p.description, p.admin_image, p.quantity, p.color, p.size FROM orders AS o JOIN products AS p ON o.id=p.order_id WHERE p.order_id={$id}");
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
        if ($req->post('item_save')) {
            $validator = Validator::make($req->all(), [
                'uploaded_images.*' => 'image|max:12000',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                // print_r($req->post());
                // print_r($req->file());
                $data = array();
            }
        }
    }
}
