@props(['name', 'label', 'type' => 'text', 'value' => null])

<div class="form-group mb-3">
    <x-label :for="$name" :value="$label" />
    <input type="{{ $type }}"
        class="form-control {{ $attributes->get('class') }} @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value) }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
