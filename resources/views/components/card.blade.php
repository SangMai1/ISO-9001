@props(['title', 'category'])
<div class="card" {{ $attributes }}>
    <div class="card-header card-header-primary">
        @isset($title)
            <h4 class="card-title ">{{ $title }}</h4>
        @endisset
        @isset($subTitle)
            <p class="card-category">{{ $subTitle }}</p>
        @endisset
    </div>
    <div class="card-body">
        {{ $body }}
    </div>
</div>
