<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Config;
use App\Images;

use PDF;

class ProductController extends Controller
{
    public function getFirst($arr) {
        return $arr[0]->getClientOriginalName();
    }
    public function create() {
        $conf = Config::first();
        return view('admin.product.create')->with('config', $conf);
    }
    public function store(Request $req) {
        $p = new Product;
        $idproduct = rand(1, 99999);

        $file = $req->file('gambar');
        foreach($file as $row) {
            $name = $row->getClientOriginalName();
            
            // Upload
            $row->storeAs('public/uploaded/', $name);

            // Insert to images
            $img = new Images;
            $img->idimage = rand(1, 99999);
            $img->product_id = $idproduct;
            $img->image = $name;
            $img->save();
        }

        $p->idproduct = $idproduct;
        $p->title = $req->title;
        $p->description = $req->description;
        $p->stock = $req->stock;
        $p->price = $req->price;
        $p->image = $this->getFirst($file);
        $p->category = $req->category;

        $p->save();

        return redirect()->route('admin.product');
    }
    public function edit($id) {
        $c = Config::first();
        $p = Product::find($id);
        return view('admin.product.edit')->with(['data' => $p, 'config' => $c]);
    }
    public function update($id, Request $req) {
        $p = Product::find($id);

        $p->title = $req->title;
        $p->description = $req->description;
        $p->stock = $req->stock;
        $p->price = $req->price;
        $p->category = $req->category;

        $p->save();

        return redirect()->route('admin.product');
    }
    public function delete($id) {
        $p = Product::find($id);
        $p->delete();

        return redirect()->route('admin.product');
    }
    public function ApiGetImages($id) {
        $imgs = Images::where('product_id', $id)->get();
        
        return response()->json($imgs);
    }
    public function search(Request $req) {
        $q = $req->q;
        $cat = $req->cat;

        $status = 200;
        $prod = Product::where([
            ['title', 'LIKE', '%'.$q.'%'],
            ['category', 'LIKE', '%'.$cat.'%'],
        ])
        ->get();
        if($prod->count() == 0) {
            $status = 404;
        }
        return response()->json(['status' => $status, 'result' => $prod]);
    }
    public function toPdf() {
        $products = Product::all();
        $pdf = PDF::loadview('product_pdf', ['products' => $products]);
        return $pdf->stream();
    }
}
