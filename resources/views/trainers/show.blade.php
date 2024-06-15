@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <section class="row mb-5">
            <div class="col-md-4">
                <div class="bg-light rounded p-3 text-center">
                    <img src="{{ $trainer->photo }}" class="rounded-circle trainer-image mx-auto d-block mb-5"
                        alt="{{ $trainer->name }}" height="150" width="150">
                    <div class="d-flex justify-content-center my-3">
                        @if ($trainer->github)
                            <a href="{{ $trainer->github }}" class="btn btn-outline-dark mx-1">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if ($trainer->linkedin)
                            <a href="{{ $trainer->linkedin }}" class="btn btn-outline-dark mx-1">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                        @if ($trainer->twitter)
                            <a href="{{ $trainer->twitter }}" class="btn btn-outline-dark mx-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if ($trainer->website)
                            <a href="{{ $trainer->website }}" class="btn btn-outline-dark mx-1">
                                <i class="fas fa-globe"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h5 class="text-success text-uppercase mb-4">A propos</h5>
                <h1 class="display-5 fw-bold">{{ $trainer->name }}</h1>
                <h4 class="lead fw-semibold">{{ $trainer->title }}</h4>
                <p class="text-muted">{{ $trainer->description }}</p>
            </div>
        </section>

        <section>
            <h2 class="fw-normal pb-3 border-bottom mb-5">Contributions</h2>
            <div class="row d-flex">
                @forelse ($courses as $course)
                    <div class="col-md-4 mb-4">
                        @include('layouts.course-card')
                    </div>
                @empty
                    <p>Aucun cours</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
