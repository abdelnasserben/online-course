<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerRequest;
use App\Models\Trainer;

class AdminTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainer::orderBy('name', 'asc')->paginate(15);
        return view('admin.trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainer = new Trainer();
        return view('admin.trainers.form', compact('trainer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRequest $request)
    {
        // Valider et créer un nouveau formateur
        $validated = $request->validated();

        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo');
        }

        Trainer::create($validated);

        return redirect()->route('admin.trainers.index')->with('success', 'Formateur créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        return view('admin.trainers.form', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainerRequest $request, Trainer $trainer)
    {
        // Valider et mettre à jour le formateur
        $validated = $request->validated();

        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo');
        }

        $trainer->update($validated);

        return redirect()->route('admin.trainers.index')->with('success', 'Formateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return redirect()->route('admin.trainers.index')->with('success', 'Formateur supprimé avec succès.');
    }
}
