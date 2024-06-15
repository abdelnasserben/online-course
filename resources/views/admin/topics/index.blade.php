@extends('layouts.base')

@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-secondary rounded-circle p-2 me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                Tous les topics
            </h1>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createTopicModal">
                Nouveau topic
            </button>
        </div>
        @if (session('success'))
            <x-alert message="{{ session('success') }}" />
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topics as $top)
                    <tr>
                        <td>{{ $top->name }}</td>
                        <td>
                            <a href="{{ route('admin.topics.edit', $top->id) }}" class="btn btn-primary">Éditer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $topics->links() }}
    </div>
@endsection

<!-- modal new topic -->

<div class="modal fade" id="createTopicModal" tabindex="-1" aria-labelledby="createTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTopicModalLabel">Nouveau topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.topics.form')
            </div>
        </div>
    </div>
</div>
