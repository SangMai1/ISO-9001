@extends('layouts.master')
@section('title', 'Test')

@section('content')

    {{-- card component --}}
    <x-card>
        @slot('title') <em>Title</em> @endslot
        @slot('subTitle') category @endslot
        @slot('body')

            {{-- table-component --}}
            <x-table :titles="['name', 'age']" auto-index="true">
                @slot('body')
                    @php $collection = [["name" =>"nam", 'age'=>14], ["name" =>"nam", 'age'=>14], ["name" =>"dung", 'age'=>14], ["name" =>"dung", 'age'=>14], ["name" =>"dung", 'age'=>14]]
                    @endphp
                    @foreach ($collection as $item)
                        <tr>
                            <td><span data-toggle="tooltip" data-html="true" title="<em>Tooltip</em>">{{ $item['name'] }}</span>
                            </td>
                            <td>{{ $item['age'] }}</td>
                        </tr>
                    @endforeach
                @endslot
            </x-table>
            
        @endslot
    </x-card>
@endsection
