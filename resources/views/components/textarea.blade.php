@props(['name', 'label', 'value' => null])

<div class="form-group mb-3">
    <x-label :for="$name" :value="$label" />
    <textarea id="{{ $name }}" name="{{ $name }}" rows="1"
        class="form-control {{ $attributes->get('class') }} @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
