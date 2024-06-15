@extends('layouts.base')
@php
    $issetTrainer = $trainer->id != null;
@endphp

@section('content')
    <div class="container pt-4">
        <h1>
            <a href="{{ route('admin.trainers.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $issetTrainer ? 'Edition' : 'Nouveau' }} formateur
        </h1>

        <form method="POST"
            action="{{ $issetTrainer ? route('admin.trainers.update', $trainer->id) : route('admin.trainers.store') }}"
            enctype="multipart/form-data">
            @csrf
            @method($issetTrainer ? 'PUT' : 'POST')

            <div class="row">
                <div class="col-md-3">
                    <x-input type="file" name="photo" label="Photo" />
                </div>
                <div class="col-md-9">
                    <x-input name="name" label="Nom" value="{{ $trainer->name }}" />
                </div>
            </div>
            <x-input name="title" label="Titre" value="{{ $trainer->title }}" />
            <x-textarea name="description" label="Description" value="{{ $trainer->description }}" />
            <div class="row">
                <div class="col-md-3">
                    <x-input type="url" name="github" label="Github" value="{{ $trainer->github }}" />
                </div>
                <div class="col-md-3">
                    <x-input type="url" name="linkedin" label="Linkedin" value="{{ $trainer->linkedin }}" />
                </div>
                <div class="col-md-3">
                    <x-input type="url" name="twitter" label="Twitter" value="{{ $trainer->twitter }}" />
                </div>
                <div class="col-md-3">
                    <x-input type="url" name="website" label="Website" value="{{ $trainer->website }}" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ $issetTrainer ? 'Modifier' : 'Créer' }}</button>
        </form>
    </div>
@endsection
