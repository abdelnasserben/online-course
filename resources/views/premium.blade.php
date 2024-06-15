@extends('layouts.base')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="display-5">Nos Tarifs</h2>
                    <p class="lead">Choisissez l'abonnement qui vous convient le mieux.</p>
                </div>
            </div>

            @if (session('warning'))
                <x-alert message="{{ session('warning') }}" />
            @endif

            <div class="row justify-content-center">
                <!-- Tarif mensuel -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Abonnement Mensuel</h5>
                            <h6 class="card-subtitle mb-2 text-primary">5€/mois</h6>
                            <p class="card-text">Profitez de tous les avantages de notre service pour seulement 5€ par
                                mois.</p>
                            <form action="{{ route('premium.subscribe') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan" value="monthly">
                                <button type="submit" class="btn btn-primary">S'abonner</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Tarif annuel -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Abonnement Annuel</h5>
                            <h6 class="card-subtitle mb-2 text-primary">45€/an</h6>
                            <p class="card-text">Économisez 15€ avec notre abonnement annuel à seulement 45€ par
                                an.</p>
                            <form action="{{ route('premium.subscribe') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan" value="yearly">
                                <button type="submit" class="btn btn-primary">S'abonner</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
