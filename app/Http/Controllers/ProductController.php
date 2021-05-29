<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();

        return response()->json([
            "message" => 'success',
            "data" => $data
        ]);


        //     try {
        //         $data = Product::all();
        //         $respone = $data;
        //         $code = 200;
        //     } catch (\Exception $e) {
        //         $code = 500;
        //         $respone = $e->getMessage();
        //     }

        //     return response()->json([
        //         'message' => $code,
        //         'data' => $respone
        //     ]);


    }


    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'active' => $request->active,
            'description' => $request->description
        ]);

        return response()->json([
            "message" => 'success',
            'date' => $product,
        ]);
    }

    public function show(Product $product)
    {

        return response()->json([
            "message" => 'success',
            'date' => $product,
        ]);
    }

    public function update($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product) {

            $product->update([
                'name' => request()->name ? request()->name : $product->name,
                'price' => request()->price ? request()->price : $product->price,
                'quantity' => request()->quantity ? request()->quantity : $product->quantity,
                'active' => request()->active ? request()->active : $product->active,
                'description' => request()->description ? request()->description : $product->description
            ]);

            return response()->json([
                "message" => 'PUT Method Success sekali ',
                'data' => $product,
            ]);
        }
        return response()->json(
            [
                "message" => 'Product dengan id ' . $id . " tidak ditemukan",
            ],
            404
        );
    }

    public function destroy($id)
    {

        $product = Product::where('id', $id)->first();

        if ($product) {
            $product->delete();

            return response()->json([
                "message" => 'DELETE Method dengan id ' . $id . ' success'
            ]);
        }

        return response()->json(
            [
                "message" => ' Product dengan id ' . $id . ' tidak ditemukan'
            ],
            400
        );
    }
}
