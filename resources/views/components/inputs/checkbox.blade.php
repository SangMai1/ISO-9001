@props(['content'])
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input {{ $attributes['class'] }}" type="checkbox" {{ $attributes }}>
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
        {{ $content }}
    </label>
</div>
