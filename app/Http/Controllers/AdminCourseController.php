<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Trainer;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        $topics = Topic::pluck('name', 'id');
        $trainers = Trainer::all()->pluck('name', 'id');
        return view('admin.courses.form', compact('course', 'topics', 'trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $validated = $request->validated();
        $validated['is_premium'] = $request->has('is_premium') ? true : false; // Ajouter la valeur de 'is_premium' au tableau validé

        $course = Course::create($validated);
        $course->trainers()->sync($validated['trainers']);

        return redirect()->route('admin.courses.index')->with('success', 'Cours créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $topics = Topic::pluck('name', 'id');
        $trainers = Trainer::all()->pluck('name', 'id');
        return view('admin.courses.form', compact('course', 'topics', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $validated = $request->validated();
        $validated['is_premium'] = $request->has('is_premium') ? true : false; // Ajouter la valeur de 'is_premium' au tableau validé
        $course->trainers()->sync($validated['trainers']);

        // Mettre à jour le cours avec les données validées
        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Cours mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Cours supprimé avec succès.');
    }
}
