<div class="table-region">

  @isset($message) <div class="alert">{{ $message }}</div> @endisset

  <x-table auto-index id="table-main" class="mobile" load-more="{{route('lichsusuachua.list')}}"
        delete-href="{{ route('lichsusuachua.delete') }}">
        @slot('head')
                                                                        
            <th class="th-mobile">Lịch sử sửa chữa</th>
                                                                   
            <th>Tài sản</th>
                                                                    
            <th>Ngày đi sửa</th>
            
            <th>Người đi sửa</th>

            <th>Giá tiền</th>

            <th class="th-action"><i class="fas fa-cogs"></i></th>   

        @endslot
        @slot('body')
            @foreach ($lichsusuachuas as $ls)
                <tr data-id="{{ $ls->id }}">
                                                                        
                    <td class="td-mobile">
                                                                
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon px-3">
                                                                                        
                            <span class="cell no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                                                                                            
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                            <div class="cell" index="3"></div>
                            <div class="cell" index="4"></div>
                        </div>
                    </td>

                                                                                        
                    <td>{{$taisans[$ls->taisanid] ?? ""}}</td>
                                                                                      
                    <td>{{ $ls->thoigiansua }}</td>

                    <td>{{ $nhanviens[$ls->nguoidisua] ?? "" }}</td>
                    
                    <td>{{ $ls->giatien }}</td>
                    <td class="td-action">
                                                                                     
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                                                                                      
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('lichsusuachua.edit') }}?id={{$ls->id}}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>