<?php

namespace App\Http\Controllers;

use Exception;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{
    public function index()
    {
        //print_r(session('cart'));
        //session()->forget('cart');
        return view('home');
    }
    public function productSearch(Request $req)
    {
        $site = $req->destination_site;
        $url = $req->product_url;
        $weidian = preg_match("/weidian.com/", $url);
        $taobao = preg_match("/taobao.com/", $url);

        if ($weidian == 1) {
            $client = new Client();

            $urlarr = explode('itemID=', $url);
            $urlarr = explode('&', $urlarr[1]);
            $product_id = $urlarr[0];

            $apiurl = "https://thor.weidian.com/detail/getDetailDesc/1.0?param=%7B%22vItemId%22%3A%22{productid}%22%7D&wdtoken=88533b22&_=1644727939067";
            $weidian_product_details = str_replace('{productid}', $product_id, $apiurl);

            $sku = "https://thor.weidian.com/detail/getItemSkuInfo/1.0?param=%7B%22itemId%22%3A%22{productid}%22%7D&wdtoken=e5739b54&_=1648583787602";
            $weidian_product_options = str_replace('{productid}', $product_id, $sku);

            try {
                $page = $client->request('GET', $url);
                $price = $page->filter('.cur-price')->text();
                $title = $page->filter('.item-name')->text();
                $image = $page->filter('.first-img')->attr('src');
                $image = explode('.webp?', $image);

                $client->request('GET', $weidian_product_options);
                $options = $client->getResponse()->getContent();
                $options = json_decode($options);
                $options = $options->result->attrList;
                $color = [];
                $size = [];

                foreach ($options as $item) {
                    if ($item->attrTitle == "颜色") {
                        $color = $item->attrValues;
                    }
                    if ($item->attrTitle == "尺寸" || $item->attrTitle == "尺码") {
                        $size = $item->attrValues;
                    }
                }

                $client->request('GET', $weidian_product_details);
                $res = $client->getResponse()->getContent();
                $details = json_decode($res);
                $details = $details->result->item_detail->desc_content;
                $other_images = [];
                $i = 0;
                foreach ($details as $item) {
                    if (array_key_exists('url', $item)) {
                        $other_images[$i] = $item->url;
                        $i += 1;
                    }
                }

                $pd = array(
                    "title" => $title,
                    "price" => $price,
                    "banner" => $image[0],
                    "other_images" => $other_images,
                    "site" => 1,
                    "url" => $url,
                    "color" => $color,
                    "size" => $size
                );
                session(['product' => (object)$pd]);
                return view('product_view', array('product' => (object)$pd));
            } catch (Exception $exception) {
                return redirect('/')->with('error', 'Please provide a valid url!');
            }
        }
        if ($taobao == 1) {
            preg_match_all("/(id=\d*)/", $url, $matches);
            $id = $matches[0][0];
            if (!$id) {
                return redirect('/')->with('error', 'Please provide a valid url!');
            }
            try {
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://taobao-tmall-product-data.p.rapidapi.com/api/sc/taobao/item_detail?item_" . $id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: taobao-tmall-product-data.p.rapidapi.com",
                        "X-RapidAPI-Key: 08be13129amshf261931bf3bffcep12e62cjsn2e88f0f25dac"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return redirect('/')->with('error', 'Please provide a valid url!');
                } else {
                    $response = json_decode($response);
                    $color = [];
                    $size = [];
                    $status = $response->code;
                    if ($status == 200) {
                        $item = $response->data;

                        foreach ($item->sku_props as $i) {
                            if ($i->prop_name == "颜色分类") {
                                foreach ($i->values as $key => $val) {
                                    $c_item = array(
                                        "attrId" => $val->vid,
                                        "attrValue" => $val->name,
                                        "img" => $val->imageUrl
                                    );
                                    $color[$key] = (object)$c_item;
                                }
                            }
                            if ($i->prop_name == "适用尺码" || $i->prop_name == "尺码") {
                                foreach ($i->values as $key => $val) {
                                    $s_item = array(
                                        "attrId" => $val->vid,
                                        "attrValue" => $val->name
                                    );
                                    $size[$key] = (object)$s_item;
                                }
                            }
                        }
                        $price = 0;
                        if (isset($item->skus[0]->sub_price)) {
                            $price = $item->skus[0]->sub_price;
                        } else {
                            $price = $item->skus[0]->sale_price;
                        }

                        $pd = array(
                            "title" => $item->title,
                            "price" => $price,
                            "banner" => $item->main_imgs[0],
                            "other_images" => $item->main_imgs,
                            "site" => 2,
                            "url" => $url,
                            "color" => $color,
                            "size" => $size
                        );
                    }
                    session(['product' => (object)$pd]);
                    return view('product_view', array('product' => (object)$pd));
                }
            } catch (Exception $exception) {
                return redirect('/')->with('error', 'Please provide a valid url!');
            }
        }
    }
    public function addtocart(Request $req)
    {
        if ($req->post('addtocart')) {
            $product = $req->post();
            $product['id'] = strtotime("now");
            $product['quantity'] = 1;
            $cart = [];
            if (session()->has('cart')) {
                $cart = session('cart');
            }
            array_push($cart, $product);
            session()->put('cart', $cart);
            return response()->json(["status" => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }
    public function deleteitemfromcart(Request $req)
    {
        if ($req->post('delete')) {
            $cart = session('cart');
            foreach ($cart as $key => $item) {
                if ($item['id'] == $req->post('id')) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                    return response()->json(['status' => 200]);
                }
            }
        }
        return response()->json(['status' => 404]);
    }
    public function cartquantity(Request $req)
    {
        if ($req->post('quantitychange')) {
            $cart = session('cart');
            foreach ($cart as $key => $item) {
                if ($item['id'] == $req->post('id')) {
                    $cart[$key]['quantity'] = $req->post('quantity');
                    session()->put('cart', $cart);
                    $res['status'] = 200;
                    return response()->json(['status' => 200]);
                }
            }
        }
        return response()->json(['status' => 404]);
    }
    public function userlogin(Request $req)
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
                $user = DB::table('users')
                    ->where('email', '=', $req->post('email'))
                    ->orWhere('username', '=', $req->post('email'))
                    ->get();
                if (Hash::check($req->post('password'), $user[0]->password)) {
                    $user = array(
                        'user_id' => $user[0]->id,
                        'username' => $user[0]->username,
                        'email' => $user[0]->email,
                    );
                    session()->put('loggedin_user', $user);
                    return redirect('/user');
                } else {
                    return redirect()->back()->withErrors(['error' => 'User not found!']);
                }
            }
        }
    }
    public function userregistration(Request $req)
    {
        if ($req->post('register')) {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'name' => 'required|min:2',
                'password' => 'required|min:6',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                try {
                    $query = DB::table('users')->insert([
                        "email" => $req->post('email'),
                        "name" => $req->post('name'),
                        "password" => bcrypt($req->post('password')),
                        "username" => $req->post('name') . strtotime("now")
                    ]);
                    if ($query) {
                        return redirect('/login')->with('login_msg', 'You have successfully registered!');
                    }
                } catch (Exception $exception) {
                    return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
                }
            }
        }
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

//$url = 'https://shop317730822.v.weidian.com/item.html?itemID=4412176101&wfr=c&ifr=itemdetail&spider_token=a986&share_relation=39c5aa4489fba769_1459959101_1';
//https://shop317730822.v.weidian.com/item.html?itemID=4474626851&wfr=c&ifr=itemdetail&share_relation=39c5aa4489fba769_1459959101_1&spider_token=9a28
//https://shop317730822.v.weidian.com/item.html?itemID=3922745323&wfr=c&ifr=itemdetail&spider_token=521b&share_relation=39c5aa4489fba769_1459959101_1


//"https://item.taobao.com/item.htm?id=585643911906&ali_refid=a3_430620_1006:1109908262:N:PBSQ%2FXgCIJAZ6Cv7KLZNKg%3D%3D:c6317ca408cdc442be867036893d688e&ali_trackid=1_c6317ca408cdc442be867036893d688e&spm=a230r.1.14.11#detail";
//"https://item.taobao.com/item.htm?spm=a230r.1.999.182.61e8523c3oSY26&id=650085739344&ns=1#detail";


 // $url1 = 'https://item.taobao.com/item.htm?spm=a230r.1.999.182.61e8523c3oSY26&id=650085739344&ns=1#detail';
//$url = 'https://shop317730822.v.weidian.com/item.html?itemID=4412176101&wfr=c&ifr=itemdetail&spider_token=a986&share_relation=39c5aa4489fba769_1459959101_1';

// $page1 = $client->request('GET', $url1);
// $a = $page1->filter('.tb-icon')->text();
// print_r($a); 

//https://thor.weidian.com/detail/getItemSkuInfo/1.0?param=%7B%22itemId%22%3A%224474626851%22%7D&wdtoken=e5739b54&_=1648583787602

// $validator = Validator::make($req->all(), [
        //     'title' => 'required',
        //     'url' => 'required',
        //     'price' => 'required',
        //     'quantity' => 'required|numeric|gt:0',
        //     'delivery_days' => 'required|numeric|gt:0',
        //     'site' => 'required',
        //     'banner' => 'required',
        //     'details' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     $product = session('product');
        //     return view('product_view', array('product' => $product, 'error' => "Quantuty and delivery days should be a valid number"));
        // }
