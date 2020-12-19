@props(['title', 'category', 'color'])
<div class="card" {{ $attributes }}>
    <div class="card-header card-header-{{ isset($color) ? $color : 'primary' }}">
        @isset($title)
            <h4 class="card-title ">{{ $title }}</h4>
        @endisset
        @isset($subTitle)
            <p class="card-category">{{ $subTitle }}</p>
        @endisset
    </div>
    <div class="card-body {{ $attributes['class'] }}" {{ $attributes }}>
        {{ $body }}
    </div>
</div>
