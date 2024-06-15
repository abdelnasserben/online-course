@extends('layouts.base')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="display-5">Nos Formateurs</h2>
                    <p class="lead">Vous souhaitez en savoir plus sur les instructeurs de Dabel ? Découvrez
                        nos éducateurs experts <br>et développeurs, ici pour vous aider à améliorer
                        vos compétences en programmation !
                    </p>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($trainers as $trainer)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('trainers.show', $trainer->id) }}" style="text-decoration: none; color: #000;">
                            <div class="card h-100">
                                <img src="{{ $trainer->photo }}" class="card-img-top rounded-circle mx-auto d-block"
                                    alt="{{ $trainer->name }}"
                                    style="width: 150px; height: 150px; object-fit: cover; margin-top: 15px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $trainer->name }}</h5>
                                    <p class="card-text">{{ $trainer->title }}</p>
                                    <div class="d-flex justify-content-center pt-4">
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
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
