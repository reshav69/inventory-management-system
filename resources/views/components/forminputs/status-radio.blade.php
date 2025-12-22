@props([
  'check' => 1, 
])

<div class="d-flex">
    <div class="form-check m-1">
        <input class="form-check-input @error('status') is-invalid @enderror"
               type="radio" 
               name="status" 
               id="status-active" 
               value="1" 
               @checked(old('status', $check) == 1)>
        <label class="form-check-label" for="status-active">
          Active
        </label>
    </div>
    
    <div class="form-check m-1">
        <input class="form-check-input @error('status') is-invalid @enderror"
               type="radio" 
               name="status" 
               id="status-inactive" 
               value="0" 
               @checked(old('status', $check) == 0)>
        <label class="form-check-label" for="status-inactive">
          Inactive
        </label>
    </div>

    @error('status')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>