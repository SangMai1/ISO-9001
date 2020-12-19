@props(['head', 'body', 'color'])
<div class="card">
    <div class="card-header card-header-tabs card-header-{{ isset($color) ? $color : 'primary' }}">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                {{-- <span class="nav-tabs-title">Tasks:</span>
                --}}
                <ul class="nav nav-tabs" data-tabs="tabs">
                    {{ $head }}
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body {{ $attributes['class'] }}" {{ $attributes }}>
        <div class="tab-content">
            {{ $body }}
        </div>
    </div>
</div>
