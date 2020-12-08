@props(['titles', 'pagination'])
<div class="table-responsive">
    <table class="table table-hover">
        <thead class=" text-primary">
            @foreach ($titles as $title)
                <th>{{ $title }}</th>
            @endforeach
        </thead>
        <tbody>
            {{ $body }}
        </tbody>
    </table>
</div>
