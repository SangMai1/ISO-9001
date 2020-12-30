<div class="table-region">

  @isset($message) <div class="alert">{{ $message }}</div> @endisset

  <x-table auto-index id="table-main" class="mobile" load-more="{{route('lichxuatxe.list')}}"
        delete-href="{{ route('lichxuatxe.delete') }}">
        @slot('head')
                                                                        
            <th class="th-mobile">Lịch xuất xe</th>
                                                                   
            <th>Xe</th>
                                                                    
            <th>Thời gian đi dự kiến</th>
            
            <th>Thời gian về dự kiến</th>

            <th>Nhân viên</th>

            <th>Địa điểm đi</th>

            <th class="th-action"><i class="fas fa-cogs"></i></th>   

        @endslot
        @slot('body')
            @foreach ($lichxuatxes as $ls)
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
                            <div class="cell" index="5"></div>
                        </div>
                    </td>

                                                                                        
                    <td>{{$xes[$ls->xeid] ?? ""}}</td>
                                                                                      
                    <td>{{ $ls->thoigiandidukien }}</td>

                    <td>{{ $ls->thoigianvedukien }}</td>

                    <td>{{ $nhanviens[$ls->nhanvienid] ?? "" }}</td>
                    
                    <td>{{ $ls->diadiemdi }}</td>
                    <td class="td-action">
                                                                                     
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                                                                                      
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('lichxuatxe.edit') }}?id={{$ls->id}}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>