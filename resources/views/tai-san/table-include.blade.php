<div class="table-region">

  @isset($message) <div class="alert">{{ $message }}</div> @endisset

  <x-table auto-index id="table-main" class="mobile" load-more="{{route('taisan.list')}}"
        delete-href="{{ route('taisan.delete') }}">
        @slot('head')
                                                                        
            <th class="th-mobile">Tài sản</th>
                                                                   
            <th>Mã</th>
                                                                    
            <th>Tên</th>
            
            <th>Giá tiền</th>

            <th>Trạng thái</th>

            <th class="th-action"><i class="fas fa-cogs"></i></th>   

        @endslot
        @slot('body')
            @foreach ($taisans as $ts)
                <tr data-id="{{ $ts->id }}">
                                                                        
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

                                                                                        
                    <td>{{ $ts->mataisan }}</td>
                                                                                      
                    <td>{{ $ts->tentaisan }}</td>

                    <td>{{ $ts->giatien }}</td>
                    
                    <td>{{ $ts->trangthai ? 'Đã qua sử dụng' : 'Hàng mới' }}</td>
                    <td class="td-action">
                                                                                     
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                                                                                      
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('taisan.edit') }}?id={{$ts->id}}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>