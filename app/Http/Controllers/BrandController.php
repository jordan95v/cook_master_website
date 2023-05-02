<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Brand::class);
        return view("brand.index", ["brands" => Brand::all()]);
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
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("brand_logo", "public");
        }
        Brand::create($form);
        return back()->with("success", "Marque correctement créé.");
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
            unlink("storage/" . $brand->image);
            $form["image"] = $request->file("image")->store("brand_logo", "public");
        }
        $brand->update($form);
        return back()->with("success", "Marque correctement modifié.");
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
        return back()->with("success", "Vous avez correctement supprimé la marque $brand->name.");
    }
}