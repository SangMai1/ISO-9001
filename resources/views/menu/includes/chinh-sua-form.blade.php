<form action="{{ route('menu.update') }}" method="POST" id="update-form" style="display: none">
    @csrf
    <input type="hidden" name="id" value="{{ $menu->id }}">
    <x-input title="Vị trí" type="text" name="vitri" float value="{{ $menu->vitri }}" />
    <x-input title="Tên menu" type="text" name="ten" float value="{{ $menu->ten }}" />
    <x-input title="Đường dẫn" type="text" name="url" float value="{{ $menu->url }}" />
    <x-input title="Icon" type="textarea" name="icon" rows="4" float>
        {{ $menu->icon }}
    </x-input>
    <div class="form-group">
        <select name="chucnangid" title="Chức năng" value="{{ $menu->chucnangid }}">
            @foreach ($chucnangs as $cn)
                <option value="{{ $cn->id }}" url="{{ $cn->url }}">{{ $cn->ten }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Thêm</button>
    <script>
        window.menuFormInit instanceof Function ?
            menuFormInit() :
            Utils.loadScript('/js/html/menu/form.js').catch(() => {
                $('#update-form').addClass(['w-100', 'text-center', 'mt-4']).html('<h2>Lỗi khi tải form</h2>').show()
            })

    </script>
</form>
