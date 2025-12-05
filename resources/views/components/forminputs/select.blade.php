@props([
    'name',
    'label' => '',
    'class' => '',
    'options' => [],
    'placeholder' => 'Select an option',
    'multiple' => false,  // true for multiple select
    'selected' => null,   // value or array of selected options
])

<label for="{{ $name }}">{{ $label }}</label>
<select 
    name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
    id="{{ $name }}" 
    class="form-control {{ $class }}" 
    {{ $multiple ? 'multiple' : '' }}>
    
    @if(!$multiple)
        <option value="">{{ $placeholder }}</option>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#{{ $name }}').select2({
            placeholder: '{{ $placeholder }}',
            width: '100%'
        });
    });
</script>
@endpush
