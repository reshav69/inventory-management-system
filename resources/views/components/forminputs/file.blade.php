@props([
    'name',
    'label' => '',
    'accept' => '',
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input 
        type="file" 
        name="{{ $name }}" 
        id="{{ $name }}"    
        class="form-control @error($name) is-invalid @enderror"
        accept="{{ $accept }}"
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
