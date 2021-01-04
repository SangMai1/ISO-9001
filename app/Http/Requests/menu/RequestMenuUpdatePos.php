<?php

namespace App\Http\Requests\menu;

use App\Models\Menu;
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
            'id' => ['required', function ($attr, $id, $fail) {
                $menu = Menu::find($id);
                if (!$menu) $fail(__('validation.exists', ['attribute' => $this->attributes()[$attr]]));
                $this->model['menu'] = $menu;
            }],
            'idcha' => ['nullable', function ($attr, $idcha, $fail) {
                $menu = $this->model['menu'];
                if (!$menu->isValidParentId($idcha)) $fail( ucfirst($this->attributes()[$attr]) . " không hợp lệ" );
            }],
            'vitri' => ["required", "Integer"],
        ];
    }

    public function attributes()
    {
        return [
            'idcha' => 'menu cha',
            'vitri' => "vị trí",
        ];
    }
}
