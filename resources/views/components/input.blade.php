@props(['title', 'error', 'float'])
@switch($attributes['type'])
    @case('radio')
    @if (!isset($error) || !$error)
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
                {{ $title ?? '' }}
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    @else
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
                {{ $title ?? '' }}
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
            <span class="invalid-feedback default" role="alert">{{ $error }}</span>
        </div>
    @endif
    @break
    @case('checkbox')

    @if (!isset($error) || !$error)
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
                {{ $title ?? '' }}
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    @else
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input {{ $attributes['class'] }}" {{ $attributes }}>
                {{ $title ?? '' }}
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
            <span class="invalid-feedback default" role="alert">{{ $error }}</span>
        </div>
    @endif

    @break
    @case('textarea')
    @if (!isset($error) || !$error)
        <div class="form-group bmd-form-group">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title ?? '' }}</label>
            <textarea class="form-control {{ $attributes['class'] }}" {{ $attributes }}>{{ $slot }}</textarea>
        </div>

    @else
        <div class="form-group bmd-form-group has-danger">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title ?? '' }}</label>
            <textarea class="form-control {{ $attributes['class'] }}" {{ $attributes }}>{{ $slot }}</textarea>
            <span class="invalid-feedback default" role="alert" class="default">{{ $error }}</span>
            <span class="form-control-feedback default"><i class="fas fa-exclamation"></i></span>
        </div>
    @endif
    @break

    @default
    @if (!isset($error) || !$error)
        <div class="form-group bmd-form-group">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title ?? '' }}</label>
            <input class="form-control {{ $attributes['class'] }}" {{ $attributes }}>
        </div>

    @else
        <div class="form-group bmd-form-group has-danger">
            <label @php if(isset($float)) echo 'class="bmd-label-floating"' @endphp>{{ $title ?? '' }}</label>
            <input class="form-control {{ $attributes['class'] }}" {{ $attributes }}>
            <span class="invalid-feedback default" role="alert" class="default">{{ $error }}</span>
            <span class="form-control-feedback default"><i class="fas fa-exclamation"></i></span>
        </div>
    @endif

@endswitch
