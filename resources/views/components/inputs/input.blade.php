@props(['title', 'error'])
<div class="form-group bmd-form-group">
    <label class="bmd-label-floating">{{ $title }}</label>
    <input class="form-control {{ $attributes['class'] }}" {{ $attributes }}>
    @isset($error)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $error }}</strong>
        </span>
    @endisset
</div>
