@props([
    'name',
    'label' => '',
    'options' => [],
    'placeholder',
    'multiple' => false,
    'selected' => null,
])

<label for="{{ $name }}">{{$label}}</label>
<div class="form-floating mb-3">
    <select class="form-select @error($name) is-invalid @enderror"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
        id="{{ $name }}" 
         
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes }}
        >
        
        @if(!$multiple)
            <option value="">{{ $placeholder ?? 'Select an option' }}</option>
        @endif
    
        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                @if($multiple && in_array($value, (array) old($name, $selected))) selected @endif
                @if(!$multiple && old($name, $selected) == $value) selected @endif
            >
                {{ $text }}
            </option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror


</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#{{ $name }}').select2({
            width: '100%',
        });
    });
</script>
@endpush
