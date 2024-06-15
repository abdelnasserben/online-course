@php
    $issetTopic = $topic->id != null;
@endphp

<form method="POST" action="{{ $issetTopic ? route('admin.topics.update', $topic->id) : route('admin.topics.store') }}">
    @csrf
    @method($issetTopic ? 'PUT' : 'POST')

    <x-input name="name" label="Nom" value="{{ $topic->name }}" />

    <button type="submit" class="btn btn-primary">{{ $issetTopic ? 'Modifier' : 'Créer' }}</button>
</form>
