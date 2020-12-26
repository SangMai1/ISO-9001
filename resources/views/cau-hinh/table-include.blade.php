<div class="table-region">
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                                    href="{{ route('cauhinh.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        
        
      
        <div class="col-md-5">
            <form action="{{ route('cauhinh.search') }}" method="GET">
                <div class="input-group ">
                    <x-input  type="search" name="search" float />
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-sm btn-info btn-icon rounded-circle"><i class="fas fa-search"></i></button>
                    </span>
                </div>
            </form>
            
        </div>
       
    </div>
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
        delete-href="{{ route('cauhinh.destroy') }}">
        @slot('head')
            <!-- field cho mobile:                                  - Không được tính index                                                             -->
            <th class="th-mobile">Cấu hình</th>

            <!-- field chính:                                       - Index mobile 1                                                                    -->
            <th>ID</th>
             <!-- field chính:                                      - Index mobile 2                                                                    -->
            <th>Mã</th>
            <!-- field chính:                                       - Index mobile 3                                                                   -->
            <th>Tên</th>
            <!-- field chính:                                       - Index mobile 4                                                                   -->
            <th>Giá trị</th>

            <!-- field cho action:                                  - Không được tính index                                                             -->
            <!-- snippet :                                          - @thAction                                                                         -->
            
            <th class="th-action"><i class="fas fa-cogs"></i></th>

        @endslot
        @slot('body')
            @foreach ($cauHinhs as $ch)
                <tr data-id="{{ $ch->id }}">
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
                            <div class="cell" index="4"></div>
                        </div>
                    </td>

                    <!-- Column chính:                              - Index là 1                                                                        -->
                    <td>{{ $ch->id }}</td>
                    <!-- Column chính:                              - Index là 2                                                                        -->
                    <td>{{ $ch->ma }}</td>
                    <!-- Column chính:                              - Index là 3                                                                        -->
                    <td>{{ $ch->ten }}</td>
                    <!-- Column chính:                              - Index là 4                                                                        -->
                    <td>{{ $ch->giatri }}</td>

                    <!-- Column cho action:                         - Không được tính index                                                             -->
                    <td class="td-action">
                        <!-- snippet:                               - @deleteButtonAction                                                               -->
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                        <!-- snippet:                               - @editLinkAction                                                                 -->         
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('cauhinh.edit', [$ch->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
