@extends('layouts.base')

@php
    $levels = ['debutant' => 'Débutant', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé'];
    $types = ['gratuit' => 'Gratuit', 'premium' => 'Premium'];
@endphp

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="display-5">Tous Nos Cours</h2>
                    <p class="lead">Découvrez nos cours exceptionnels conçus pour répondre à tous vos besoins. Rejoignez
                        <br>notre communauté et profitez d'avantages exclusifs dès aujourd'hui.
                    </p>
                </div>
            </div>
            
            <form action="{{ route('courses.index') }}" method="GET" class="row" id="courseFilters">
                <div class="col-lg-3 bg-light p-3 rounded h-100 mb-4">
                    <div class="input-group mb-4">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="search" name="search" class="form-control border-start-0" placeholder="Rechercher..."
                            value="{{ request()->input('search') }}" id="search">
                    </div>
                    <div class="mb-4">
                        <h6>Topic</h6>

                        @foreach ($topics as $topic)
                            <div class="form-check">
                                <input class="form-check-input topics" type="checkbox" name="topic[]"
                                    value="{{ $topic->id }}" id="topic{{ $topic->id }}" @checked(request()->has('topic') && in_array($topic->id, explode(',', request()->input('topic'))))>
                                <label class="form-check-label" for="topic{{ $topic->id }}">
                                    {{ $topic->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Filtres par Niveau -->
                    <div class="mb-4">
                        <h6>Niveau</h6>

                        @foreach ($levels as $levelKey => $levelValue)
                            <div class="form-check">
                                <input class="form-check-input levels" type="checkbox" name="level[]"
                                    value="{{ $levelKey }}" id="{{ $levelKey }}" @checked(request()->has('level') && in_array($levelKey, explode(',', request()->input('level'))))>
                                <label class="form-check-label" for="{{ $levelKey }}">
                                    {{ $levelValue }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Filtres par Type -->
                    <div class="mb-4">
                        <h6>Type</h6>
                        @foreach ($types as $typeKey => $typeValue)
                            <div class="form-check">
                                <input class="form-check-input types" type="checkbox" name="type[]"
                                    value="{{ $typeKey }}" id="{{ $typeKey }}" @checked(request()->has('type') && in_array($typeKey, explode(',', request()->input('type'))))>
                                <label class="form-check-label" for="{{ $typeKey }}">
                                    {{ $typeValue }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-md-6 mb-4">
                                @include('layouts.course-card')
                            </div>
                        @empty
                            <div class="bg-light p-5 rounded text-center">
                                <h3>Hmm…</h3>
                                <p>Aucun cours n'a été trouvé.</p>

                                <div class="flex justify-center gap-4 mt-6">
                                    <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">Annulez toutes
                                        les
                                        filtres</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </form>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $courses->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </section>
@endsection
