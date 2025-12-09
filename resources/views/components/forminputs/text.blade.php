@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value',
    'id',
    'class'=>'',
])

<div class="form-floating mb-3 {{ $class }}">
    <input class="form-control @error($name) is-invalid @enderror"
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ??$name }}"
    
    placeholder="{{ $label }}"
    value="{{$value ??old($name)}}"
    {{ $attributes }}
    >
    <label for="{{ $name }}">{{ $label }}</label>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

