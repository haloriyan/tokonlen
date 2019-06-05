<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Config;
use App\Orderan;
use Illuminate\Http\Request;

class OrderanController extends Controller
{
    public function checkout($id) {
        $ord = Orderan::find($id);
        $ord->status = 0;
        $ord->save();

        return redirect()->route('user.orderan');
    }
    public function mine() {
        $conf = Config::first();
        $myData = Auth::user();

        // get orderan data
        $orderData = Orderan::where('user_id', $myData->iduser)->first();

        // get detail order
        // get orderId
        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', '!=', 9]])->get();
        if($myOrder->count() == 0) {
            $myCart = "null";
        }else {
            $myCart = DB::table('detail_order')
                        ->where('order_id', $myOrder[0]->idorder)
                        ->join('products', 'product_id', '=', 'products.idproduct')
                        ->get();
        }

        return view('orderan')->with(['config' => $conf, 'myData' => $myData, 'myCart' => $myCart, 'myOrder' => $orderData]);
    }
}
