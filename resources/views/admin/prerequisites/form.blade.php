@extends('layouts.base')

@php
    $issetPrerequisite = $prerequisite->id != null;
@endphp

@section('content')
    <div class="container pt-4">
        <h1>
            <a href="{{ route('admin.sections.index', ['course' => $course->id]) }}"
                class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $issetPrerequisite ? $prerequisite->title : 'Titre' }}
        </h1>

        <form method="POST"
            action="{{ $issetPrerequisite ? route('admin.prerequisites.update', ['course' => $course->id, 'prerequisite' => $prerequisite->id]) : route('admin.prerequisites.store', ['course' => $course->id]) }}">
            @csrf
            @method($issetPrerequisite ? 'PUT' : 'POST')

            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <x-input name="title" label="Prérequis" value="{{ $prerequisite->title }}" />

            <button type="submit" class="btn btn-primary">{{ $issetPrerequisite ? 'Modifier' : 'Créer' }}</button>
        </form>
    </div>
@endsection
