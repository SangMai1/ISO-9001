<div class="table-region">
    <a href="/nhom/them-moi" class="btn btn-sm btn-info"><i class="fas fa-plus-circle"></i></a>
    <form action="{{ route('nhom.search') }}" method="GET">
                <div class="form-group">
                    <x-input title="Tìm kiếm" type="text" name="search" float />
                    <button type="submit" class="btn btn-sm btn-info">Tìm kiếm</button>

                </div>
            </form>
    @isset($message) <div class="alert">{{ $message }}</div> @endisset

                                                
    <x-table auto-index id="table-main" class="mobile" load-more="{{route('nhom.list')}}"
        delete-href="{{ route('nhom.delete') }}">
        @slot('head')
            

        @endslot
        @slot('body')
            @foreach ($nhoms as $n)
                <tr data-id="{{ $n->id }}">
                                                                        
                    <td class="td-mobile">
                                                                
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon px-3">
                                                                                        
                            <span class="cell no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                                                                                            
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                        </div>
                    </td>

                                                                                        
                    <td>{{ $n->ma }}</td>
                                                                                      
                    <td>{{ $n->ten }}</td>

                                                                              
                    <td class="td-action">
                                                                                     
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                                                                                      
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('nhom.edit', [$n->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
