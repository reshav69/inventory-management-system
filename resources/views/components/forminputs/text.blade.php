@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'class'=>'',
])

<div class="form-floating mb-3 {{ $class }}">
    <input class="form-control"
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    
    placeholder="{{ $label }}"
    value="{{ $value ?? old($name)}}"
    >
    <label for="{{ $name }}">{{ $label }}</label>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

