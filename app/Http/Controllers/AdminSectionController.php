<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Course;
use App\Models\Section;

class AdminSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return view('admin.sections.index', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin.sections.form', [
            'course' => $course,
            'section' => new Section(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request, Course $course)
    {
        Section::create($request->validated());
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Section créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Section $section)
    {
        return view('admin.sections.form', [
            'course' => $course,
            'section' => $section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Course $course, Section $section)
    {
        $section->update($request->validated());
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Section modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Section supprimée avec succès.');
    }
}
