<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Orderan;
use App\Notification;
use Illuminate\Http\Request;
use \App\Http\Controllers\ConfigController as Config;
use \App\Http\Controllers\UserController as User;

class OrderanController extends Controller
{
    public static function get($userId) {
        $ordData = Orderan::where('user_id', $userId)->get()->count();
        return $ordData;
    }
    public function getPriceFromShipping($str) {
        $ret = preg_match("/\((.*?)\)/", $str, $arr);
        return $arr;
    }
    public function getShippingName($shipping, $price) {
        $e = explode($price, $shipping);
        return $e[0];
    }
    public function checkout($id, Request $req) {
        $ship = $req->shipping;
        $shippingPrice = $this->getPriceFromShipping($ship);
        $shippingName = $this->getShippingName($ship, $shippingPrice[0]);

        $ord = Orderan::find($id);
        $ord->status = 0;
        $ord->shipping = $shippingName;
        $ord->shipping_price = $shippingPrice[1];
        $ord->save();

        return redirect()->route('user.orderan');
    }
    public function mine() {
        $conf = Config::get();
        $myData = User::myData();

        // get detail order
        // get orderId
        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', '!=', 9], ['status', '!=', 8]])->get();
        // if($myOrder->count() == 0) {
        //     $myCart = "null";
        // }else {
        //     $myCart = DB::table('detail_order')
        //                 ->where('order_id', $myOrder[0]->idorder)
        //                 ->join('products', 'product_id', '=', 'products.idproduct')
        //                 ->get();
        // }

        if($myData != "") {

            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        return view('orderan')->with(['config' => $conf, 'myData' => $myData, 'myOrder' => $myOrder]);
    }
    public function detailOrder($id) {
        $conf = Config::get();
        $myData = User::myData();

        // get detail order
        // get orderId
        $myOrder = Orderan::where([['idorder', $id], ['status', '!=', 9]])->first();
        if($myOrder->count() == 0) {
            $myCart = "null";
        }else {
            $myCart = DB::table('detail_order')
                        ->where('order_id', $myOrder->idorder)
                        ->join('products', 'product_id', '=', 'products.idproduct')
                        ->get();
        }

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        return view('detailOrder')->with(['config' => $conf, 'myData' => $myData, 'myCart' => $myCart, 'myOrder' => $myOrder]);
    }
    public function confirmationPage($id = NULL) {
        $conf = Config::get();
        $myData = User::myData();
        if($myData == "") {
            $myData = "private";
        }

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', '0']])->get();
        return view('confirmation')->with(['config' => $conf, 'myData' => $myData, 'myOrder' => $myOrder, 'toPay' => $id]);
    }
    public function confirmation(Request $req) {
        $id = $req->idorder;

        $ord = Orderan::find($id);
        $ord->status = 1;
        $ord->save();

        return redirect()->route('payment.success');
    }
    public function barangSampai(Request $req) {
        $id = $req->idorder;

        $prod = Orderan::find($id);
        $prod->status = 1;
        $prod->save();

        return redirect()->route('user.orderan');
    }
}
