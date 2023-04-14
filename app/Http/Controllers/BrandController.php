<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
