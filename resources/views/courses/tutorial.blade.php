@extends('layouts.base')

@php
    $viewableTutorial = !$tutorial->is_premium || ($tutorial->is_premium && auth()->user()?->is_premium)
@endphp

@section('content')
    <section class="container pt-5">
        <div class="col-lg-8">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb fs-6">
                    <li class="breadcrumb-item small"><a href="{{ route('courses.index') }}">Cours</a></li>
                    <li class="breadcrumb-item small"><a
                            href="{{ route('courses.show', ['course' => $tutorial->course()->id]) }}">{{ $tutorial->course()->title }}</a>
                    </li>
                    <li class="breadcrumb-item small active" aria-current="page">{{ $tutorial->title }}</li>
                </ol>
            </nav>
            <h1 class="display-6 fw-semibold mb-5 ">{{ $tutorial->title }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-8">
                @if ($viewableTutorial)
                    <div class="video-section mb-4">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/J-graiyPhpw?si=RpjywuzaKMqy0dXo"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                @else
                    <div class="ratio ratio-16x9 bg-light position-relative mb-4">
                        <div class="h-auto position-absolute top-50 start-50 translate-middle text-center">
                            <p>Contenu destiné aux membres premiums</p>
                            <a href="{{ route('premium.index') }}" class="btn btn-primary">
                                <i class="fas fa-star"></i> Devenir premium
                            </a>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button
                        class="btn btn-sm btn-outline-secondary rounded-pill">{{ $tutorial->course()->getLevelLabel() }}</button>
                    <a href="{{ route('courses.tutorial.source', ['tutorial' => $tutorial->id]) }}"
                        class="btn btn-outline-primary">
                        <i class="fas fa-code"></i>
                        Télécharger le code source
                    </a>
                </div>

                <h4 class="fw-normal border-top border-secondary border-4 pt-3 mb-4">A propos du tutoriel</h4>
                <p class="lead">{{ $tutorial->description }}</p>

                <h4 class="fw-normal my-4">Commentaires</h4>
                @auth

                    @if ($viewableTutorial)
                        @include('layouts.comment-form', [
                            'action' => route('comment.store'),
                        ])
                    @else
                        <a class="text-decoration-none" href="{{ route('premium.index') }}">Devenez Premium pour commenter</a>
                    @endif
                @endauth
                @guest
                    <a class="text-decoration-none" href="{{ route('login') }}">Connectez-vous pour commenter</a>
                @endguest

                <div class="my-4">
                    @foreach ($comments as $comment)
                        @if ($comment->parent)
                            <div class="row border p-3" style="background: rgba(243, 242, 242, 0.6)">
                                <p class="small m-0">Réponse à :</p>
                                <a class="text-decoration-none text-muted"
                                    href="#comment-{{ $comment->parent->id }}">{{ Str::limit($comment->parent->content, 50) }}</a>
                            </div>
                        @endif
                        <div class="row p-3 border bg-light mb-3" id="comment-{{ $comment->id }}">
                            <div class="col-auto">
                                <img src="{{ $comment->user->avatar }}" alt="Photo de l'utilisateur"
                                    class="img-fluid rounded-circle" height="40" width="40">
                            </div>
                            <div class="col">
                                <strong>{{ $comment->user->name }}</strong>
                                <div class="text-muted">
                                    {{ $comment->created_at->format('y-m-d H:i') }}

                                    @if (auth()->check())
                                        <span class="ms-2">
                                            <a data-bs-toggle="collapse" href="#collapseExample{{ $comment->id }}"
                                                role="button" aria-expanded="false"
                                                aria-controls="collapseExample{{ $comment->id }}"
                                                class="text-outline-dark">
                                                <i class="fas fa-reply"></i> Répondre
                                            </a>
                                        </span>
                                    @endif
                                </div>
                                <p>{{ $comment->content }}</p>
                                <div class="collapse" id="collapseExample{{ $comment->id }}">
                                    <div class="ms-2 p-2 border-start">
                                        @include('layouts.comment-form', [
                                            'action' => route('comment.reply', $comment->id),
                                            'parentId' => $comment->id,
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                @foreach ($tutorial->course()->sections as $section)
                    <div class="card shadow-sm mb-4">
                        <div class="card-body px-0">
                            <h5 class="card-title px-4 mb-3">{{ $section->title }}</h5>
                            @foreach ($section->tutorials as $tuto)
                                <a href="{{ route('courses.tutorial', ['tutorial' => $tuto->id]) }}"
                                    class="d-block d-flex align-items-center text-decoration-none text-reset link-bg-hover px-3 py-1 my-2 {{ $tuto->id == $tutorial->id ? 'bg-light' : '' }}">
                                    <span
                                        class="d-flex justify-content-center align-items-center p-2 rounded-circle bg-light me-3"
                                        style="width: 35px; height: 35px">
                                        @if (($tuto->is_premium && !auth()->check()) || ($tuto->is_premium && !auth()->user()?->is_premium))
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="fas fa-{{ $tuto->id == $tutorial->id ? 'pause' : 'play' }}"></i>
                                        @endif
                                    </span>
                                    {{ $tuto->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
