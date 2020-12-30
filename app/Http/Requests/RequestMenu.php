<?php

namespace App\Http\Requests;

use App\Models\chucnangs;
use App\Models\Menu;
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
            'idcha' => ['nullable', function($attr, $idCha, $fail){
                if(isset($_REQUEST['id']) && ($_REQUEST['id'] == $idCha)){
                    $fail('Menu cha không hợp lệ');
                }
            },'exists:menus,id'],
            'ten' => "required|min:2|max:100",
            'vitri' => "nullable|Integer",
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
