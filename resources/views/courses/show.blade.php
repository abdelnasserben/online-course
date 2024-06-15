@extends('layouts.base')

@php
    $sections = $course->sections()->withCount('tutorials')->get();
    $totalSections = $sections->count();
    $totalTutorials = $course->tutorials()->count();
@endphp

@section('content')
    <section class="bg-light py-5">
        <div class="container">
            <div class="col-lg-6 col-xl-7">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb fs-6">
                        <li class="breadcrumb-item small"><a href="{{ route('courses.index') }}">Cours</a></li>
                        <li class="breadcrumb-item small active">{{ $course->title }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-semibold mb-4">{{ $course->title }}</h1>
                <div class="text-muted mb-5">
                    <span class="border rounded-pill bg-white px-3 py-1">{{ ucfirst($course->getLevelLabel()) }}</span>
                    <span class="mx-4">
                        <i class="far fa-clock text-primary"></i> {{ $course->sections()->count() }} sections</span>

                    <span>
                        <i class="far fa-file-alt text-primary"></i> {{ $course->tutorials()->count() }} leçons</span>
                </div>
                <p class="text-muted mb-4">{{ $course->short_description }}</p>
                <div class="d-flex">
                    <span class="text-muted me-3">Partager :</span>
                    <a href="#" class="text-dark me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-dark me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-dark "><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="container pt-5">
        <div class="col-lg-6 col-xl-7">
            <div class="course-absolute-card mb-4">
                <div class="card h-100">
                    <div class="position-relative">
                        <img class="card-img-top" src="{{ $course->picture }}" height="200" alt="">
                        @if ($course->is_premium)
                            <span class="badge bg-danger position-absolute top-0 start-0 py-2 ms-3 mt-3">PRO</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <a href="{{ route('courses.tutorial', ['tutorial' => $course->tutorials()->first()->id]) }}"
                            class="d-block btn btn-primary rounded-pill mx-3 mt-3 py-2">
                            Commencer le cours
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <hr class="my-4">

                        <h5 class="lead text-primary fs-6 mb-4">FORMATEUR</h5>
                        @foreach ($course->trainers as $trainer)
                            <a href="{{ route('trainers.show', $trainer->id) }}"
                                class="d-block text-decoration-none text-reset  mb-2">
                                <div class="row">
                                    <div class="col-auto">
                                        <img src="{{ $trainer->photo }}" class="rounded-circle trainer-photo"
                                            alt="{{ $trainer->name }}" title="{{ $trainer->name }}" height="40"
                                            width="40">
                                    </div>
                                    <div class="col">
                                        <h6>{{ $trainer->name }}</h6>
                                        <p class="text-muted small fw-semibold">{{ $trainer->title }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <h3 class="fw-normal mb-4">Description</h3>
            <p class="lead mb-4">{{ $course->description }}</p>
            <h3 class="fw-normal mb-3">Pré-requis</h3>
            <ul class="mb-5">
                @forelse ($course->prerequisites as $prerequisite)
                    <li class="lead">{{ $prerequisite->title }}</li>
                @empty
                    <li>Aucun</li>
                @endforelse
            </ul>
            <h3 class="fw-normal mb-4">Sommaire</h3>
            @foreach ($course->sections as $section)
                <div class="card shadow-sm mb-4">
                    <div class="card-body px-0">
                        <h5 class="card-title px-4 mb-3">{{ $section->title }}</h5>
                        @foreach ($section->tutorials as $tutorial)
                            <a href="{{ route('courses.tutorial', ['tutorial' => $tutorial->id]) }}"
                                class="d-block d-flex align-items-center text-decoration-none text-reset link-bg-hover px-3 py-1 my-2">
                                <span
                                    class="d-flex justify-content-center align-items-center p-2 rounded-circle bg-light me-3"
                                    style="width: 35px; height: 35px">
                                    @if (($tutorial->is_premium && !auth()->check()) || ($tutorial->is_premium && !auth()->user()?->is_premium))
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="fas fa-play"></i>
                                    @endif
                                </span>
                                {{ $tutorial->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
