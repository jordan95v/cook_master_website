<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Course;
use App\Models\Formation;
use App\Models\FormationCourse;
use App\Models\FormationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::all();
        $search = request()->get("search");
        $filter = request()->get("filter");
        $formations = Formation::when($search, function ($query, $search) {
            return $query->where("name", "like", "%$search%");
        })
            ->when($filter, function ($query, $filter) {
                // filter are most_student and most_courses, we use relation count to get the number of courses and users
                if ($filter == "most_student") {
                    return $query->withCount("formation_users")->orderBy("formation_users_count", "desc");
                } else if ($filter == "most_courses") {
                    return $query->withCount("courses")->orderBy("courses_count", "desc");
                } else {
                    return $query;
                }
            })
            ->whereHas("courses")
            ->simplePaginate(10);
        return view("formations.index", ["formations" => $formations, "filter" => $filter]);
    }

    public function list_index()
    {
        $user = User::find(Auth::id());
        $formations = ($user->isAdmin()) ? Formation::all() : $user->formations;
        return view("formations.list_index", ["formations" => $formations]);
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
        return redirect()->route("formation.show", $formation)->with("success", "Formation created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        $user = User::find(Auth::id());
        if (count($formation->courses) == 0 && (!$user->isAdmin() && !$formation->user->is($user))) {
            return back()->with("error", "This formation doesn't have any courses.");
        }
        $formation_user = FormationUser::where("formation_id", $formation->id)
            ->where("user_id", $user->id)->first();
        return view("formations.show", ["formation" => $formation, "formation_user" => $formation_user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        $this->authorize("update", $formation);
        return view("formations.edit", ["formation" => $formation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $form = $request->validated();
        if ($request->hasFile("image")) {
            if (file_exists("storage/" . $formation->image)) {
                unlink("storage/" . $formation->image);
            }
            $form["image"] = $request->file("image")->store("formations", "public");
        }
        $formation->update($form);
        return back()->with("success", "Formation updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $this->authorize("delete", $formation);
        $formation->delete();
        return back()->with("success", "Formation deleted.");
    }

    public function add_courses(Formation $formation)
    {
        $this->authorize("delete", $formation);
        $user = User::find(Auth::id());
        $formation_courses_ids = [];
        foreach ($formation->courses as $item) {
            $formation_courses_ids[] = $item->course->id;
        }
        $courses = ($user->isAdmin()) ? Course::all() : $user->courses;
        return view("formations.add_courses", [
            "formation" => $formation,
            "formation_courses_ids" => $formation_courses_ids,
            "courses" => $courses,
        ]);
    }

    public function store_courses(Formation $formation, Request $request)
    {
        $this->authorize("delete", $formation);
        $form = $request->validate([
            "courses" => "required|array",
            "courses.*" => "required|exists:courses,id",
        ]);
        // So it reset correctly
        FormationCourse::where("formation_id", $formation->id)->delete();
        foreach ($form["courses"] as $course_id) {
            FormationCourse::create([
                "formation_id" => $formation->id,
                "course_id" => $course_id,
            ]);
        }
        return redirect()->route("formation.show", $formation)->with("success", "Courses added.");
    }

    private function download_certification(User $user, Formation $formation)
    {
        $taken_formation = FormationUser::where("formation_id", $formation->id)
            ->where("user_id", $user->id)
            ->first();

        if (!$taken_formation->image) {
            $taken_formation->create_certification_image();
        }
        return Response::download(public_path("storage/" . $taken_formation->image));
    }

    public function get_certification(Formation $formation)
    {
        $user = User::find(Auth::id());
        $formation_user = FormationUser::where("formation_id", $formation->id)
            ->where("user_id", $user->id)
            ->first();

        if ($formation_user->can_get_certification()) {
            return $this->download_certification($user, $formation);
        } else {
            return back()->with("error", "You don't have complteted all the courses required for this certification.");
        }
    }

    public function take(Formation $formation)
    {
        if (FormationUser::where("formation_id", $formation->id)->where("user_id", Auth::id())->count() > 0) {
            return back()->with("error", "You already have this formation.");
        }
        FormationUser::create([
            "formation_id" => $formation->id,
            "user_id" => Auth::id(),
        ]);
        return redirect()->route("formation.show", $formation)->with("success", "Formation taken.");
    }
}
