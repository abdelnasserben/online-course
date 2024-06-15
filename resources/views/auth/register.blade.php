@extends('layouts.base')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h1 class="display-5">Inscription</h1>
                    <p class="lead">Heureux de nous rejoindre !</p>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="avatar" value="">
                    <x-input name="name" label="Nom" />
                    <x-input type="email" name="email" label="Email" />
                    <x-input type="password" name="password" label="Mot de passe" />
                    <x-input type="password" name="password_confirmation" label="Confirmez le mot de passe" />
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">S'inscrire</button>
                        <span>Pas de compte ? <a href="{{ route('login') }}">se connecter</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
