@props(['title', 'error', 'float'])
@switch($attributes['type'])
    @case('radio')
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
            {{ $title }}
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>
    @break
    @case('checkbox')
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
            {{ $title }}
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
        </label>
    </div>
    @break

    @default
    @isset($error)
        <div class="form-group bmd-form-group has-danger">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title }}</label>
            <input class="form-control {{ $attributes['class'] }}" {{ $attributes }}>
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $error }}</strong>
            </span>
        </div>
    @else
        <div class="form-group bmd-form-group">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title }}</label>
            <input class="form-control {{ $attributes['class'] }}" {{ $attributes }}>
        </div>
    @endisset

@endswitch
