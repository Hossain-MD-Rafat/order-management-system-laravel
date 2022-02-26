<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class Home extends Controller
{
    //
    private $results = array();

    public function index()
    {
        $client = new Client();

        $url = 'https://shop317730822.v.weidian.com/item.html?itemID=4412176101&wfr=c&ifr=itemdetail&spider_token=a986&share_relation=39c5aa4489fba769_1459959101_1';

        $weidian_product_details = "https://thor.weidian.com/detail/getDetailDesc/1.0?param=%7B%22vItemId%22%3A%224412176101%22%7D&wdtoken=88533b22&_=1644727939067";

        $page = $client->request('GET', $url);
        $price = $page->filter('.cur-price')->text();
        $title = $page->filter('.item-name')->text();
        $image = $page->filter('.first-img')->attr('src');
        $image = explode('.webp?', $image);

        $client->request('GET', $weidian_product_details);
        $res = $client->getResponse()->getContent();
        $details = json_decode($res);
        $details = $details->result->item_detail->desc_content;

        $pd = array(
            "title" => $title,
            "price" => $price,
            "banner" => $image[0],
            "details" => $details
        );

        // $url1 = 'https://item.taobao.com/item.htm?spm=a230r.1.999.182.61e8523c3oSY26&id=650085739344&ns=1#detail';

        // $page1 = $client->request('GET', $url1);
        // $a = $page1->filter('.tb-icon')->text();
        // print_r($a);


        return view('home');
    }
}
