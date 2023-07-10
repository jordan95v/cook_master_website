<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FormationUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ["user", "formation"];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function can_get_certification()
    {
        $user = $this->user;
        $match = 0;
        foreach ($this->formation->courses as $formation_course) {
            foreach ($user->finished_courses as $user_course) {
                if ($formation_course->course->is($user_course->course) && $user_course->is_finished) {
                    $match++;
                }
            }
        }
        return $match == count($this->formation->courses);
    }

    public function create_certification_image()
    {
        $user = $this->user;
        $image = imagecreatefrompng(public_path("images/certification.png"));
        $color = imagecolorallocate($image, 0, 0, 0);
        $text = "$user->name";
        imagestring($image, 20, 520, 300, $text, $color);

        $text = "Certified on " . date("d/m/Y");
        imagestring($image, 5, 455, 350, $text, $color);

        $text = "For completing all the course of: ";
        imagestring($image, 5, 400, 450, $text, $color);

        $name = $this->formation->name;
        $text = "$name";
        imagestring($image, 5, 450, 490, $text, $color);

        ob_start();
        imagepng($image);
        $path = "certifications/certification-" . $user->id . "-" . $this->id . ".png";
        Storage::disk("public")->put($path, ob_get_contents());
        ob_end_clean();
        imagedestroy($image);

        $this->image = $path;
        $this->is_finished = true;
        $this->save();
    }
}
