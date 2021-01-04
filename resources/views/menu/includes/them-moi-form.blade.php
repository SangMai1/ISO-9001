<form action="{{ route('menu.store') }}" method="POST" id="update-form" style="display: none">
    @csrf
    <x-input title="Vị trí" type="text" name="vitri" float />
    <x-input title="Tên menu" type="text" name="ten" float />
    <x-input title="Đường dẫn" type="text" name="url" float />
    <x-input title="Icon" type="textarea" name="icon" rows="4" float />
    <div class="form-group">
        <select name="chucnangid" title="Chức năng">
            @foreach ($chucnangs as $cn)
                <option value="{{ $cn->id }}" url="{{ $cn->url }}">{{ $cn->ten }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Thêm</button>
    <div style="height: 3500px; width:10px">123</div>
    <script>
        window.menuFormInit instanceof Function
            ? menuFormInit()
            : Utils.loadScript('/js/html/menu/form.js').catch(() => {
                $('#update-form').addClass(['w-100', 'text-center', 'mt-4']).html('<h2>Lỗi khi tải form</h2>').show()
            })
    </script>
</form>
