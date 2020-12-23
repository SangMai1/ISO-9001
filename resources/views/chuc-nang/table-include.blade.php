<div class="table-region">
    @isset($message) <div class="alert">{{ $message }}</div> @endisset

    <!-- snippet:                                                   - @tableComponent                                                                   -->
    <!-- auto-index:                                                - Tự động đánh index cho table sau khi render                                       -->
    <!-- select:                                                    - Tự động thêm cột select cho table                                                 -->
    <!-- class['moblile']:                                          - Đánh dấu table được được viết cho table -> kèm css, js render config theo         -->
    <!-- delete-href:                                               - Đánh dấu table có có chức năng delete                                                 
                                                                        -> js sẽ tự động tim tới selector element ('.delete-btn') gắn event:                
                                                                            -> call ajax-delete                                                             
                                                                                ( với cấu hình mặc định của ajaxSetting                                     
                                                                                    ( config trong file ( master-layout.ts -> find(\$.ajaxSetup) ) )        
                                                                        -> xóa record sau khi render                                                    -->
    <x-table auto-index id="table-main" class="mobile" select 
        delete-href="{{ route('chucnang.delete') }}">
        @slot('head')
            <!-- field cho mobile:                                  - Không được tính index                                                             -->
            <th class="th-mobile">Chức năng</th>

            <!-- field chính:                                       - Index mobile 1                                                                    -->
            <th>ID</th>
            <!-- field chính:                                       - Index mobile 2                                                                    -->
            <th>Tên</th>
            <!-- field chính:                                       - Index mobile 3                                                                    -->
            <th>Đường dẫn</th>

            <!-- field cho action:                                  - Không được tính index                                                             -->
            <!-- snippet :                                          - @thAction                                                                         -->
            <th class="th-action"><i class="fas fa-cogs"></i></th>

        @endslot
        @slot('body')
            @foreach ($chucNangs as $cn)
                <tr data-id="{{ $cn->id }}">
                    <!--  Colum cho mobile:                         - Không được tính index                                                             -->
                    <td class="td-mobile">
                        <!-- snippet:                               - @collapseGroup                                                                    -->
                        <!-- class['auto-icon']:                    - Để icon toggle về cuối về sát cuối                                                -->
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon">
                            <!-- class['.cell']:                    - Đánh dấu element sẽ tự động thêm content từ <td>  vào bên trong,                  
                                                                        thêm header vào phía trước                                                   
                                                                            -> dựa vào attribute[index]                                                 -->
                            <!-- class['.no-title']:                - Không kèm nội dụng title ở tag <th> head                                          -->
                            <!-- index:                             - Xác định cột nào sẽ được chọn để render                                           -->
                            <span class="cell no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                            <!-- snippet:                           - @cellDivMobile                                                                    -->
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                            <div class="cell" index="3"></div>
                        </div>
                    </td>

                    <!-- Column chính:                              - Index là 1                                                                        -->
                    <td>{{ $cn->id }}</td>
                    <!-- Column chính:                              - Index là 2                                                                        -->
                    <td>{{ $cn->ten }}</td>
                    <!-- Column chính:                              - Index là 3                                                                        -->
                    <td>{{ $cn->url }}</td>

                    <!-- Column cho action:                         - Không được tính index                                                             -->
                    <td class="td-action">
                        <!-- snippet:                               - @deleteButtonAction                                                               -->
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                        <!-- snippet:                               - @editLinkAction                                                                 -->         
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('chucnang.edit') }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
