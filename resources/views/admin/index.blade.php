@extends('layouts.base')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="display-5">Administration</h2>
                    <p class="lead">Découvrez nos cours exceptionnels conçus pour répondre à tous vos besoins. Rejoignez
                        <br>notre communauté et profitez d'avantages exclusifs dès aujourd'hui.
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-dark me-2">Gestion de cours et
                    topics</a>
                <a href="{{ route('admin.trainers.index') }}" class="btn btn-dark">Gestion de formateurs</a>
            </div>
        </div>
    </section>
@endsection
