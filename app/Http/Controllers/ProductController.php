<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Config;
use App\Images;

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

        $p->title = $req->title;
        $p->description = $req->description;
        $p->stock = $req->stock;
        $p->price = $req->price;
        // $p->category = $req->category;
        $p->image = $this->getFirst($file);
        $p->category = "test";

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
        // $p->category = $req->category;
        $p->category = "test";

        $p->save();

        return redirect()->route('admin.product');
    }
    public function delete($id) {
        $p = Product::find($id);
        $p->delete();

        return redirect()->route('admin.product');
    }
    public function curel() {
        $req = new Client([
            'base_uri' => 'http://localhost:8000'
        ]);

        $res = $req->request('GET', 'test');
        echo $res;
    }
}
