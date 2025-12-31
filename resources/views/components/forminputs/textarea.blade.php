@props([
    'name',
    'label' => '',
    'class'=>'',
    'value'=>'',
])

<label for="{{ $name }}">{{ $label }}</label>

<div class="form-floating mb-3 @error($name) is-invalid @enderror">
    <textarea class="form-control"
     name="{{ $name }}"
     id="{{ $name }}"
     placeholder="{{ $label }}"
    {{$attributes}}>{{ $value ?? old($name) }}
    </textarea> 

</div>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
@push('scripts')
    
<script>
    CKEDITOR.replace({{ $name }}, {
        removeButtons: 'Image,Table,HorizontalRule,SpecialChar,Iframe,Flash'
    });
    
</script>
@endpush