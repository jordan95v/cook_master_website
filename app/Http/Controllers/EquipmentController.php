<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\Brand;
use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Equipment::class);
        return view("equipment.index", ["equipments" => Equipment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Equipment::class);
        return view("equipment.create", ["brands" => Brand::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request)
    {
        $this->authorize("create", Equipment::class);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("equipments", "public");
        }
        $form["user_id"] = Auth::id();
        Equipment::create($form);
        return redirect("/")->with("success", "You have created an equipment");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        $this->authorize("update", $equipment);
        return view("equipment.edit", ["equipment" => $equipment, "brands" => Brand::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $this->authorize("update", $equipment);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("images", "public");
        }
        $equipment->update($form);
        return redirect("/equipment")->with("success", "You have edited an equipment");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $this->authorize("delete", $equipment);
        $equipment->delete();
        return redirect("/equipment")->with("success", "You have deleted an equipment");
    }
}
