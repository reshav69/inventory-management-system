@props([
    'name',
    'label' => '',
    'options' => [],
    'placeholder' => 'Select an option',
    'selected' => null,
])

<label for="{{ $name }}">{{ $label }}</label>

<div class="form-floating mb-3">
    <select
        class="form-select @error($name) is-invalid @enderror"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>

        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                {{ old($name, $selected) == $value ? 'selected' : '' }}>
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
    $(document).ready(function () {
        $('#{{ $name }}').select2({
            width: '100%',
        });
    });
</script>
@endpush
