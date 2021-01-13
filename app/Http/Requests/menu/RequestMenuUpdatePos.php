<?php

namespace App\Http\Requests\menu;

use App\Models\Menu;
use App\Util\CommonUtil;
use Illuminate\Foundation\Http\FormRequest;

class RequestMenuUpdatePos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $model = [];
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
            'id' => ['required', CommonUtil::checkExists(Menu::class, 'id', $this)],
            'idcha' => ['nullable', function ($attr, $idcha, $fail) {
                $menu = $this->_data['id'];
                if (!$menu->isValidParentId($idcha)) $fail(ucfirst($this->attributes()[$attr]) . " không hợp lệ");
            }],
            'vitri' => ["required", "Integer"],
        ];
    }

    public function attributes()
    {
        return [
            'idcha' => 'Menu cha',
            'vitri' => "Vị trí",
        ];
    }
}
