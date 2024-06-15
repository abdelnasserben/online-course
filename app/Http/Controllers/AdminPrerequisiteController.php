<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Course;
use App\Models\Prerequisite;

class AdminPrerequisiteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin.prerequisites.form', [
            'course' => $course,
            'prerequisite' => new Prerequisite(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request, Course $course)
    {
        Prerequisite::create($request->validated());
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Prérequis créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Prerequisite $prerequisite)
    {
        return view('admin.prerequisites.form', [
            'course' => $course,
            'prerequisite' => $prerequisite,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Course $course, Prerequisite $prerequisite)
    {
        $prerequisite->update($request->validated());
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Prérequis modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Prerequisite $prerequisite)
    {
        $prerequisite->delete();
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Prérequis supprimé avec succès.');
    }
}
