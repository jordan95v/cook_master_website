<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Brand::class);
        $brands = (User::find(Auth::id())->isAdmin() ? Brand::all() : Auth::user()->brands);
        return view("brand.index", ["brands" => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Brand::class);
        return view("brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $this->authorize("create", Brand::class);
        $form = $request->validated();
        $form["slug"] = strtolower(str_replace(" ", ",", $form["name"]));
        $form["image"] = $request->file("image")->store("brands", "public");
        $form["user_id"] = Auth::id();
        Brand::create($form);
        return back()->with("success", "Brand successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view("brand.show", ["brand" => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $this->authorize("update", $brand);
        return view("brand.edit", ["brand" => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->authorize("update", $brand);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            if (file_exists("storage/" . $brand->image)) {
                unlink("storage/" . $brand->image);
            }
            $form["image"] = $request->file("image")->store("brand_logo", "public");
        }
        $brand->update($form);
        return back()->with("success", "Brand successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->authorize("delete", $brand);
        if (file_exists("storage/" . $brand->image)) {
            unlink("storage/" . $brand->image);
        }
        $brand->delete();
        return back()->with("success", "Brand successfully deleted.");
    }
}
