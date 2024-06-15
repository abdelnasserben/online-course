@extends('layouts.base')

@section('content')
    <div class="container pt-5">
        <h1>
            <a href="{{ route('admin.topics.index') }}" class="btn btn-sm btn-secondary rounded-circle me-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            Edition topic
        </h1>
        @include('admin.topics.form')
    </div>
@endsection
