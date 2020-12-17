@props(['pagination'])
<div class="table-responsive">
    <table class="table table-hover {{ $attributes['class'] }}" {{ $attributes }}>
        <thead class=" text-primary">
            {{ $head }}
        </thead>
        <tbody>
            {{ $body }}
        </tbody>
    </table>
</div>
