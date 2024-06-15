@extends('layouts.base')

@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>
                <a href="{{ route('admin.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                Tous les formateurs
            </h1>
            <a href="{{ route('admin.trainers.create') }}" class="btn btn-sm btn-success me-2">Nouveau formateur</a>
        </div>
        @if (session('success'))
            <x-alert message="{{ session('success') }}" />
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainers as $trainer)
                    <tr>
                        <td>{{ $trainer->name }}</td>
                        <td>{{ $trainer->title }}</td>
                        <td>
                            <a href="{{ route('admin.trainers.edit', $trainer->id) }}" class="btn btn-primary" title="Editer">
                                <i class="far fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.trainers.destroy', $trainer->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Supprimer"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $trainers->links() }}
    </div>
@endsection
