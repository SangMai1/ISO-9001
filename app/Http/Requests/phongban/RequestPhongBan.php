<?php

namespace App\Http\Requests\phongban;

use App\Models\Nhanviens;
use App\Models\PhongBan;
use App\Util\CommonUtil;
use Illuminate\Foundation\Http\FormRequest;

class RequestPhongBan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['nullable', CommonUtil::checkExists(PhongBan::class, 'id', $this)],
            'ma' => 'required',
            'ten' => 'required',
            'truongphong' => ['nullable', CommonUtil::checkExists(Nhanviens::class)],
        ];
    }
}
