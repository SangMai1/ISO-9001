<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLichSuSuaChua extends FormRequest {

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
        return  [
            'thoigiansua' => 'required',
            'giatien' => 'required|string|min:3',
            'ghichu' => 'required|string|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'thoigiansua' => 'Thời gian sửa',
            'giatien' => 'Giá tiền',
            'ghichu' => 'Ghi chú'
        ];
    }
}