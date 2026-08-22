<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
       
         if($request->filled("search")){ 
         $search = $request->search;
           $query->where(function($q)use($search){
             $q->where("name", "like", "%$search%")
             ->orWhere("price", "like", "%$search%");
           });
         }
         
        $field= $request->get("short", 'created_at');
        $assending= $request->get("up", 'desc');

        $paginate= $request->get("perpage", 5);

        $query->orderBy($field,$assending);


        $products =  $query->latest()->paginate($paginate)->withQueryString();
        return response()->json([
            "success" => true,
            "data" =>   $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required",
            "qty" => "required",
            "photo" => "nullable|image|mimes:png,jpg,jpeg|max:5000",
            "status" => "nullable",
            "description" => "nullable",
        ]);

        try {
            $product = Product::create($request->all());

            return response()->json([
                "success" => true,
                "data" => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "data" => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json([
            "success" => true,
            "data" =>  $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => "nullable",
            "price" => "nullable",
            "qty" => "nullable",
            "photo" => "nullable",
            "status" => "nullable",
            "description" => "nullable",
        ]);

        try {

            if ($request->hasFile("photo")) {
                $photo = $request->file("photo");
                $photo_name = $request->name . time() . "." . $photo->getClientOriginalExtension();
                $photo->move(public_path("uploads"), $photo_name);
                $product->photo = $photo_name;
            }else{
                 $product->photo = $product->photo;
            }

            $product->name= $request->name;
            $product->price= $request->price;
            $product->qty= $request->qty;
            $product->status= $request->status;
            $product->description= $request->description;
            $product->update();

            return response()->json([
                "success" => true,
                "data" => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "data" => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            "success" => true,
            "data" => "successfully deleted"
        ]);
    }
}
