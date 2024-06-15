@extends('layouts.base')

@php
    $issetSection = $section->id != null;
@endphp

@section('content')
    <div class="container pt-4">
        <h1>
            <a href="{{ route('admin.sections.index', ['course' => $course->id]) }}"
                class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $issetSection ? $section->title : 'Nom de la section' }}
        </h1>

        <form method="POST"
            action="{{ $issetSection ? route('admin.sections.update', ['course' => $course->id, 'section' => $section->id]) : route('admin.sections.store', $course->id) }}">
            @csrf
            @method($issetSection ? 'PUT' : 'POST')

            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <x-input name="title" label="Nom de la section" value="{{ $section->title }}" />

            <button type="submit" class="btn btn-primary">{{ $issetSection ? 'Modifier' : 'Créer' }}</button>
        </form>
    </div>
@endsection
