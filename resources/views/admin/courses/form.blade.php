@extends('layouts.base')
@php
    $levels = ['debutant' => 'Débutant', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé'];
    $issetCourse = $course->id != null;
@endphp

@section('content')
    <div class="container pt-4">
        <h1>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $issetCourse ? 'Edition' : 'Nouveau' }} cours
        </h1>

        <form method="POST"
            action="{{ $issetCourse ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}">
            @csrf
            @method($issetCourse ? 'PUT' : 'POST')

            <x-input name="title" label="Titre" value="{{ $course->title }}" />
            <x-textarea name="short_description" label="Briève description" value="{{ $course->short_description }}" />
            <x-textarea name="description" label="Description" value="{{ $course->description }}" />
            <x-select name="topic_id" label="Topic" :options="$topics" selected="{{ $course->topic_id }}" />
            <x-select name="level" label="Niveau" :options="$levels" selected="{{ $course->level }}" />
            <x-select2 name="trainers" label="Formateurs" :options="$trainers" :selected="old('trainers', $course->trainers->pluck('id')->toArray())" />
            <x-checkbox name="is_premium" label="Premium" :checked="old('is_premium', $course->is_premium)" />

            <button type="submit" class="btn btn-primary">{{ $issetCourse ? 'Modifier' : 'Créer' }}</button>
        </form>
    </div>
@endsection
