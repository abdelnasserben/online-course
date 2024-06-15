@props(['name', 'label', 'options', 'selected' => null])

<div class="form-select mb-3">
    <x-label :for="$name" :value="$label" />
    <select class="form-select {{ $attributes->get('class') }} @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}">
        <option value="">-- select option --</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ $selected == $optionValue ? 'selected' : '' }}>{{ $optionLabel }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
