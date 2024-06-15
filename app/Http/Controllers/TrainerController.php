<?php

namespace App\Http\Controllers;

use App\Models\Trainer;

class TrainerController extends Controller
{
    public function trainers()
    {
        $trainers = Trainer::orderBy('name', 'asc')->get();
        return view('trainers.index', [
            'trainers' => $trainers
        ]);
    }

    public function showTrainer(Trainer $trainer)
    {
        $courses = $trainer->courses;
        return view('trainers.show', [
            'trainer' => $trainer,
            'courses' => $courses
        ]);
    }
}
