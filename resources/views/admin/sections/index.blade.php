@extends('layouts.base')


@section('content')
    <div class="container mt-5">


        <div class="card mb-4">
            <div class="card-body">
                <h4>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    {{ $course->title }}
                </h4>
                <p>{{ $course->short_description }}</p>
                <p class="badge text-bg-dark py-2">{{ $course->getPremiumLabel() }}</p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-md-7">

                <div class="d-flex align-items-center mb-4">
                    <h2 class="me-3">Contenu</h2>
                    <a href="{{ route('admin.sections.create', $course->id) }}"
                        class="btn btn-sm btn-primary rounded-circle" title="Ajouter une section">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

                @foreach ($course->sections as $section)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{ $section->title }}</span>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm rounded-circle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.sections.edit', ['course' => $course->id, 'section' => $section->id]) }}">Modifier</a>
                                    <form action="{{ route('admin.sections.destroy', [$course->id, $section->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer la section ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($section->tutorials as $tutorial)
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <span>
                                        @if ($tutorial->is_premium)
                                            <i class="fas fa-star text-warning"></i>
                                        @endif
                                        {{ $tutorial->title }}
                                    </span>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm rounded-circle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.tutorials.edit', ['course' => $course->id, 'section' => $section->id, 'tutorial' => $tutorial->id]) }}">Modifier</a>
                                            <form
                                                action="{{ route('admin.tutorials.destroy', ['course' => $course->id, 'section' => $section->id, 'tutorial' => $tutorial->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer la session ?')">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('admin.tutorials.create', ['course' => $course->id, 'section' => $section->id]) }}"
                                class="btn btn-sm btn-outline-primary mt-3">
                                <i class="fas fa-plus"></i> Ajouter une session
                            </a>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('admin.sections.create', $course->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Ajouter
                </a>
            </div>

            <div class="col-md-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="me-3">Prérequis</h2>
                    <a href="{{ route('admin.prerequisites.create', $course->id) }}"
                        class="btn btn-sm btn-primary rounded-circle" title="Ajouter un prérequis">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        @forelse ($course->prerequisites as $prerequisite)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2 mb-2">
                                {{ $prerequisite->title }}
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary btn-sm rounded-circle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.prerequisites.edit', ['course' => $course->id, 'prerequisite' => $prerequisite->id]) }}">Modifier</a>
                                        <form
                                            action="{{ route('admin.prerequisites.destroy', ['course' => $course->id, 'prerequisite' => $prerequisite->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer le prérequis ?')">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            aucun
                        @endforelse
                        <a href="{{ route('admin.prerequisites.create', $course->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus"></i> Ajouter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
