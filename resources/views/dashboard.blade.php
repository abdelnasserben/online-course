@extends('layouts.base')

@php
    $user = Auth::user();
@endphp

@section('content')
    <div class="container mt-5">

        @if (session('success'))
            <x-alert message="{{ session('success') }}" />
        @endif

        <div class="col-md-6 offset-md-3">
            <h3>Bienvenue, {{ $user->name }} !</h3>
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-fluid rounded-circle">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Déconnexion</button>
            </form>
        </div>
    </div>
@endsection
