<div class="table-region">
  
    <a href="/xe/them-moi" class="btn btn-sm btn-info"><i class="fas fa-plus-circle"></i></a>
    <form action="{{ route('xe.search') }}" method="GET">
        <div class="form-group">
            <x-input title="Tìm kiếm" type="text" name="search" float />
            <button type="submit" class="btn btn-sm btn-info">Tìm kiếm</button>

        </div>
    </form>

  @isset($message) <div class="alert">{{ $message }}</div> @endisset

  <x-table auto-index id="table-main" class="mobile" load-more="{{route('xe.list')}}"
        delete-href="{{ route('xe.delete') }}">
        @slot('head')
                                                                        
            <th class="th-mobile">Xe</th>
                                                                   
            <th>Tài sản</th>
                                                                    
            <th>Biển số</th>
            
            <th>Số chỗ</th>

            <th>Nhân viên</th>

            <th>Số lần sửa chữa</th>

            <th class="th-action"><i class="fas fa-cogs"></i></th>   

        @endslot
        @slot('body')
            @foreach ($xes as $x)
                <tr data-id="{{ $x->id }}">
                                                                        
                    <td class="td-mobile">
                                                                
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon px-3">
                                                                                        
                            <span class="cell no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                                                                                            
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                            <div class="cell" index="3"></div>
                            <div class="cell" index="4"></div>
                            <div class="cell" index="5"></div>
                        </div>
                    </td>

                                                                                        
                    <td>{{$taisans[$x->taisanid] ?? ""}}</td>
                                                                                      
                    <td>{{ $x->bienso }}</td>

                    <td>{{ $x->socho }}</td>
                    
                    <td>{{ $nhanviens[$x->nhanvienid] ?? ""}}</td>

                    <td>{{ $soLanSuaChua->where('taisanid', '=', $x->taisanid)->count()}}</td>
                    
                    <td class="td-action">
                                                                                     
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                                                                                      
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('xe.edit') }}?id={{$x->id}}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                        href="{{ route('lichsusuachua.create') }}?id={{$x->taisanid}}"><i class="fas fa-tools"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>