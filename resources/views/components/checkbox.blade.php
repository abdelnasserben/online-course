@props(['name', 'label', 'checked' => false])

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}"
        {{ $checked ? 'checked' : '' }}>
    <x-label :for="$name" :value="$label" class="form-check-label" />
</div>
