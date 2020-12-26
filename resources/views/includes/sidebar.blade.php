<div class="sidebar" data-color="azure" data-background-color="white">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->
    <div class="logo"><span class="simple-text logo-normal">
            ISO-9001
        </span></div>
    <div class="sidebar-wrapper">

        {{-- sidebar group --}}
        <ul class="nav">
            <li class="nav-item ">
                <a data-toggle="collapse" class="nav-link dropdown-toggle auto-icon">
                    <i class="material-icons">admin_panel_settings</i>Quản trị hệ thống
                </a>
                <ul class="collapse list-unstyled">
                    <li class="nav-item">
                        <a data-toggle="collapse" class="nav-link dropdown-toggle auto-icon">
                            <i class="material-icons">admin_panel_settings</i>Nhân viên
                        </a>
                        <ul class="collapse list-unstyled">
                            <li class="nav-item">
                                <a href="{{ route('nhanvien.list') }}" class="nav-link">Xem nhân viên</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" active="khoiPhucTaiKhoan">Khôi phục mật khẩu</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Xóa tài khoản</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" class="nav-link dropdown-toggle auto-icon">
                            <i class="fas fa-shield-alt"></i>Chức năng
                        </a>
                        <ul class="collapse list-unstyled">
                            <li class="nav-item">
                                <a href="{{ route('chucnang.list') }}" class="nav-link"><i class="fas fa-list"></i>Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chucnang.create') }}" class="nav-link"><i class="fas fa-plus-circle"></i>Thêm chức năng</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('danhmuc.list') }}?loai=1" active="listPhongBan" class="nav-link"><i class="fas fa-list"></i><span>Phòng ban</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('danhmuc.list') }}?loai=0" active="listChucDanh" class="nav-link"><i class="fas fa-list"></i><span>Chức danh</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('danhmuc.list') }}?loai=2" class="nav-link"><i class="fas fa-list"></i><span>Loại tài sản</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cauhinh.list') }}" active="listLoaiTaiSan" class="nav-link"><i class="fas fa-list"></i><span>Cấu hình</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item ">
                <a data-toggle="collapse" class="nav-link dropdown-toggle auto-icon">
                    <i class="fas fa-car"></i>Quản lí xe
                </a>
                <ul class="collapse list-unstyled">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-list"></i>
                            <p>Danh sách xe</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-history"></i>
                            Lịch xuất xe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/quan-li-xe/lich-sua-xe" active="lichSuaXe" class="nav-link">
                            <i class="fa fa-history"></i>
                            Lịch sử sửa chữa xe
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/quan-li-cuoc-hop">
                    <i class="material-icons">content_paste</i>
                    <span>Quản lí cuộc họp</span>
                </a>
            </li>

            <li class="nav-item drop-down">
                <a class="nav-link" href="/tai-san">
                    <i class="material-icons">library_books</i>
                    <span>Quản lí tài sản</span>
                </a>
            </li>

        </ul>
    </div>
</div>
