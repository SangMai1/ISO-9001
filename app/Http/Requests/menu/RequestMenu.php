<?php

namespace App\Http\Requests\menu;

use App\Models\chucnangs;
use App\Models\Menu;
use App\Util\CommonUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Psy\debug;

class RequestMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['nullable', CommonUtil::checkExists(Menu::class, 'id', $this)],
            'idcha' => ['required', 'exists:menus,id'],
            'ten' => ["required", "min:2", "max:100"],
            'vitri' => ["required", "Integer"],
            'chucnangid' => ['nullable', 'Integer', function ($attr, $id, $fail) {
                if (chucnangs::find($id) == null)
                    $fail('Chức năng không hợp lệ');
            }],
        ];
    }

    public function attributes()
    {
        return [
            'idcha' => 'menu cha',
            'ten' => "tên menu",
            'vitri' => "vị trí",
            'chucnangid' => 'chức năng',
        ];
    }
}
