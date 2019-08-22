<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Images;
use App\Product;

class ImagesController extends Controller
{
    public function store(Request $req) {
        $productId = $req->product_id;
        $image = $req->file('image');
        $imageName = $image->getClientOriginalName();

        // Upload image
        $upl = $image->storeAs('public/uploaded/', $imageName);

        // Add to database
        $img = new Images;
        $img->idimage = rand(1, 99999);
        $img->product_id = $productId;
        $img->image = $imageName;
        $img->save();

        return response()->json(['status' => 'ok']);
    }
    public function delete(Request $req) {
        $imageId = $req->idimage;

        $img = Images::find($imageId);
        $fileName = $img->image;

        Storage::disk('public')->delete("/uploaded/".$fileName);
        $img->delete();

        return response()->json(['status' => 'ok']);
    }
}
