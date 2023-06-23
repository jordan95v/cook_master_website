<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use App\Models\FormationCourse;
use App\Models\FormationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Formation::withCount("courses")->where("courses_count", ">", 0)->simplePaginate(10);
        return view("formations.index", ["formations" => $res]);
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
        if (count($formation->courses) == 0) {
            return back()->with("error", "This formation doesn't have any courses.");
        }
        return view("formations.show", ["formation" => $formation]);
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
        $formation_courses_ids = [];
        foreach ($formation->courses as $item) {
            $formation_courses_ids[] = $item->course->id;
        }
        return view("formations.add_courses", [
            "formation" => $formation,
            "formation_courses_ids" => $formation_courses_ids,
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
        $response = new StreamedResponse(function () use ($user, $formation) {
            $image = imagecreatefrompng(public_path("images/certification.png"));
            $color = imagecolorallocate($image, 0, 0, 0);
            $text = "$user->name";
            imagestring($image, 20, 520, 300, $text, $color);

            $text = "Certified on " . date("d/m/Y");
            imagestring($image, 5, 455, 350, $text, $color);

            $text = "For completing all the course of: ";
            imagestring($image, 5, 400, 450, $text, $color);

            $text = "$formation->name";
            imagestring($image, 5, 485, 490, $text, $color);

            imagepng($image);
            imagedestroy($image);
        });
        $response->headers->set('Content-Type', 'image/png');
        $response->headers->set('Content-Disposition', 'attachment; filename="download.jpg"');
        return $response;
    }

    public function get_certification(Formation $formation, Request $request)
    {
        $user = User::find(Auth::id());
        $match = 0;

        foreach ($formation->courses as $formation_course) {
            foreach ($user->finished_courses as $user_course) {
                if ($formation_course->course->id == $user_course->course->id) {
                    $match++;
                }
            }
        }

        if ($match == count($formation->courses)) {
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
