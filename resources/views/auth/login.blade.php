@extends('layouts.base')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h1 class="display-5">Connexion</h1>
                    <p class="lead">Heureux de vous revoir !</p>
                </div>
            </div>
            <div class="col-md-6 mx-auto">

                @if (session('success'))
                    <x-alert message="{{ session('success') }}" />
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <x-input type="email" name="email" label="Email" />
                    <x-input type="password" name="password" label="Mot de passe" />
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Se connecter</button>
                        <span>Pas de compte ? <a href="{{ route('register') }}"> s'inscrire</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
