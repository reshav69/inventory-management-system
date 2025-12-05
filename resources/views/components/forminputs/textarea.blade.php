@props([
    'name',
    'label' => '',
    'class'=>'',
    'value'=>'',
])

<label for="{{ $name }}">{{ $label }}</label>
<div class="form-floating mb-3 {{ $class }}">
    <textarea class="form-control"
     name="{{ $name }}"
     id="{{ $name }}"
     placeholder="{{ $label }}"
     >{{ $value ?? old($name) }}</textarea>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@push('scripts')
    
<script>
    CKEDITOR.replace({{ $name }}, {
        removeButtons: 'Image,Table,HorizontalRule,SpecialChar,Iframe,Flash'
    });
    
</script>
@endpush