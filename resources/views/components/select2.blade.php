@props(['name', 'label', 'options', 'selected' => []])

<div class="form-select mb-3">
    <x-label :for="$name" :value="$label" />
    <select name="{{ $name }}[]" multiple="multiple"
        class="form-select {{ $attributes->get('class') }} @error($name) is-invalid @enderror" id="{{ $name }}">
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ in_array($value, $selected) ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
