<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCauHinh extends FormRequest
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
        return  [
            'ma' => 'required|string|min:5',
            'ten' => 'required|string|min:6',
            'giatri' => 'required|string|min:3'
        ];
    }

    public function attributes()
    {
        return [
            'ma' => 'Mã cấu hình ',
            'ten' => 'Tên cấu hình',
            'giatri' => 'Giá trị'
        ];
    }
    
}
