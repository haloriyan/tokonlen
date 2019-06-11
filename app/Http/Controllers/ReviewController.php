<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Review;
use App\Orderan;

class ReviewController extends Controller
{
    public static function canIWriteReview($user_id, $product_id) {
        /*
            Syarat
            * Status order = 1

         */
        // $cekOrderan = Orderan::where([['user_id', $user_id], ['status', '=', '1']])->get()->count();
        $cekOrderan = DB::table('orderan')
                        ->where([
                            ['user_id', $user_id]
                        ])
                        ->join('detail_order', 'orderan.idorder', '=', 'detail_order.order_id')
                        ->get();

        $query = DB::raw("SELECT * FROM orderan INNER JOIN detail_order ON (orderan.idorder = detail_order.order_id AND detail_order.product_id = '$product_id') WHERE user_id = '$user_id' AND status = '1'");
        $cekOrderan = DB::select($query);
        $cekReview = Review::where([['user_id', $user_id], ['product_id', $product_id]])->get()->count();
        
        if(count($cekOrderan) > 0) {
            return true;
        }else {
            return false;
        }
    }
    public function testFunc() {
        echo $this->canIWriteReview('9306', '5');
        exit();
        if($this->canIWriteReview('9302', '5')) {
            echo "true";
        }else {
            echo "false";
        }
    }
}
