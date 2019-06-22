<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Review;
use App\Orderan;

class ReviewController extends Controller
{
    public function store(Request $req) {
        $myData = Auth::user();

        $rev = new Review;
        $rev->product_id = $req->product_id;
        $rev->user_id = $myData->iduser;
        $rev->rate = 5;
        $rev->comment = $req->comment;
        $rev->save();

        return redirect()->route('product.view', $req->product_id);
    }
}
