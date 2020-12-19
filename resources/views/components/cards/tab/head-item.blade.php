@props(['content'])
<li class="nav-item">
    <a class="nav-link {{ $attributes['class'] }}" data-toggle="tab" {{ $attributes }}>
        {{$slot}}
    </a>
</li>
