<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Config;

class CategoryController extends Controller
{
    public function allCat() {
        header("Access-Control-Allow-Origin");
        $allCat = Category::all();
        return response()->json($allCat);
    }
    public function create() {
        $conf = Config::first();
        return view('admin.category.create')->with('config', $conf);
    }
    public function store(Request $req) {
        $cat = new Category;
        $cat->idcategory = rand(1, 9999);
        $cat->category = $req->nama;
        $cat->save();

        return redirect()->route('admin.category');
    }
    public function edit($id) {
        $cat = Category::find($id);
        $conf = Config::first();
        
        return view('admin.category.edit')->with(['config' => $conf, 'category' => $cat]);
    }
    public function update($id, Request $req) {
        $cat = Category::find($id);
        $cat->category = $req->nama;
        $cat->save();

        return redirect()->route('admin.category');
    }
    public function delete(Request $req) {
        $id = $req->id;
        $cat = Category::find($id);
        $cat->delete();

        return response()->json(['message' => 'sukses']);
    }
}
