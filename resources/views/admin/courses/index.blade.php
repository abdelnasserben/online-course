@extends('layouts.base')

@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>
                <a href="{{ route('admin.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                Tous les cours
            </h1>
            <div>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-sm btn-success me-2">Nouveau cours</a>
                <a href="{{ route('admin.topics.index') }}" class="btn btn-sm btn-dark">Géstion de topics</a>
            </div>
        </div>
        @if (session('success'))
            <x-alert message="{{ session('success') }}" />
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Topic</th>
                    <th>Niveau</th>
                    <th>Premium</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->topic->name }}</td>
                        <td>{{ $course->getLevelLabel() }}</td>
                        <td>{{ $course->is_premium ? 'Oui' : 'Non' }}</td>
                        <td>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary" title="Editer">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.sections.index', $course->id) }}" class="btn btn-warning" title="Programmes">
                                <i class="fa-solid fa-bars-progress"></i>
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Suprimer"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}" target="_blank"
                                class="btn btn-dark" title="Voir">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $courses->links() }}
    </div>
@endsection
