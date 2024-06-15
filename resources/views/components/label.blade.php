
@props(['for', 'value'])

<label for="{{ $for }}" class="{{ $attributes->merge(['class' => 'form-label'])->get('class') }}">
    {{ $value }}
</label>