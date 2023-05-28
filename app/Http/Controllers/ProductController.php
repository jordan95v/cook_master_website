<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Product::class);
        $products = (User::find(Auth::id())->isAdmin() ? Product::all() : Auth::user()->products);
        return view("product.index", ["products" => $products]);
    }

    public function storeIndex(Request $request)
    {
        $products = Product::simplePaginate(15);
        if ($request->get("brand")) {
            $products = $products->where("brand_id", "=", $request->brand);
        }
        if ($request->get("filter")) {
            switch ($request->filter) {
                case 'up':
                    $products = $products->sortBy("price");
                    break;

                case 'down':
                    $products = $products->sortByDesc("price");
                    break;

                case 'new':
                    $products = $products->sortByDesc("id");
                    break;
            }
        }

        return view("shop.store", ["products" => $products, "brands" => Brand::all(), "requestBrand" => $request->get("brand"), "filter" => $request->get("filter")]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Product::class);
        return view("product.create", ["brands" => Brand::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize("create", Product::class);
        $form = $request->validated();
        $form["image"] = $request->file("image")->store("products", "public");
        $form["user_id"] = Auth::id();
        Product::create($form);
        return back()->with("success", "Product successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $seeblings = Product::where("brand_id", "=", $product->brand->id)->where("id", "!=", $product->id)->get();
        return view("product.show", ["product" => $product, "seeblings" => $seeblings]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize("update", $product);
        return view("product.edit", ["product" => $product, "brands" => Brand::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize("update", $product);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            if (file_exists("storage/" . $product->image)) {
                unlink("storage/" . $product->image);
            }
            $form["image"] = $request->file("image")->store("brand_logo", "public");
        }
        $product->update($form);
        return back()->with("success", "Product successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize("delete", $product);
        if (file_exists("storage/" . $product->image)) {
            unlink("storage/" . $product->image);
        }
        $product->delete();
        return back()->with("success", "Product successfully deleted.");
    }
}
