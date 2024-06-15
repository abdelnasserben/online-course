<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorialRequest;
use App\Models\Course;
use App\Models\Section;
use App\Models\Tutorial;

class AdminTutorialController extends Controller
{
    /**
     * Ce controlleur aura souvent besoin de paramètres cours, section même sans en utiliser.
     * En effet, c'est juste pour respecter les arguments des url de la forme: admin/courses/{course}/section/{section}/tutorials
     */
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course, Section $section)
    {
        return view('admin.tutorials.form', [
            'section' => $section,
            'tutorial' => new Tutorial(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TutorialRequest $request, Course $course, Section $section)
    {
        $validated = $request->validated();
        $validated['is_premium'] = $request->has('is_premium') ? true : false; // Ajouter la valeur de 'is_premium' au tableau validé
        Tutorial::create($validated);

        return redirect()->route('admin.sections.index', [
            'course' => $course,
        ])->with('success', 'Session créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Section $section, Tutorial $tutorial)
    {
        return view('admin.tutorials.form', [
            'section' => $section,
            'tutorial' => $tutorial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TutorialRequest $request, Course $course, Section $section, Tutorial $tutorial)
    {
        $validated = $request->validated();
        $validated['is_premium'] = $request->has('is_premium') ? true : false; // Ajouter la valeur de 'is_premium' au tableau validé
        $tutorial->update($validated);

        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Session modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Section $section, Tutorial $tutorial)
    {
        $tutorial->delete();
        return redirect()->route('admin.sections.index', ['course' => $course])->with('success', 'Session supprimée avec succès.');
    }
}
