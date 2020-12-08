@props(['titles', 'pagination', 'autoIndex'])
<div {{ $attributes->merge(['class' => 'table-responsive']) }}>
    <table class="table table-hover" @php if(isset($autoIndex) && $autoIndex === true) echo('auto-index="true"') @endphp> 
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
