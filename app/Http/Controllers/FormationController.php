<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Formation::class);
        return view("formations.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        $form = $request->validated();
        $form["user_id"] = Auth::id();
        $form["image"] = $request->file("image")->store("formations", "public");
        $formation = Formation::create($form);
        return redirect()->route("formation.show", $formation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        return view("formations.show", ["formation" => $formation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        //
    }

    public function add_courses(Formation $formation)
    {
        $this->authorize("delete", $formation);
        return view("formations.add_courses", ["formation" => $formation]);
    }
}
