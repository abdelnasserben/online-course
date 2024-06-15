@extends('layouts.base')

@php
    $issetTutorial = $tutorial->id != null;
@endphp

@section('content')
    <div class="container pt-4">
        <h1>
            <a href="{{ route('admin.sections.index', ['course' => $section->course->id]) }}"
                class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $issetTutorial ? $section->title : 'Nom de la session' }}
        </h1>

        <form method="POST"
            action="{{ $issetTutorial ? route('admin.tutorials.update', ['course' => $section->course->id, 'section' => $section->id, 'tutorial' => $tutorial->id]) : route('admin.tutorials.store', ['course' => $section->course->id, 'section' => $section->id]) }}">
            @csrf
            @method($issetTutorial ? 'PUT' : 'POST')

            <input type="hidden" name="section_id" value="{{ $section->id }}">
            <x-input name="title" label="Nom de la session" value="{{ $tutorial->title }}" />
            <x-input name="video_url" label="URL de la session" value="{{ $tutorial->video_url }}" />
            <x-textarea name="description" label="Description" value="{{ $tutorial->description }}" />
            <x-checkbox name="is_premium" label="Premium" :checked="old('is_premium', $tutorial->is_premium)" />

            <button type="submit" class="btn btn-primary">{{ $issetTutorial ? 'Modifier' : 'Créer' }}</button>
        </form>
    </div>
@endsection
