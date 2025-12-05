@props([
    'name',
    'label' => '',
    'checked' => false,
])

<div class="form-check mb-3">
    <input 
        class="form-check-input @error($name) is-invalid @enderror" 
        type="checkbox" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="1"
        {{ old($name, $checked) ? 'checked' : '' }}
        {{ $attributes }}
    >
    @if($label)
        <label class="form-check-label" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
