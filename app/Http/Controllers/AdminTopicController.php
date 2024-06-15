<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;

class AdminTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topic = new Topic();
        $topics = Topic::paginate(15);
        return view('admin.topics.index', compact('topic', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {

        Topic::create($request->validated());
        return redirect()->route('admin.topics.index')->with('success', 'Topic créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());
        return redirect()->route('admin.topics.index')->with('success', 'Topic mis à jour avec succès.');
    }
}
