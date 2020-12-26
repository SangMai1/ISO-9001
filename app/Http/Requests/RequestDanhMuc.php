<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDanhMuc extends FormRequest
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
            'ten' => 'required|string',
            'ma' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'ten' => 'Tên danh mục',
            'ma' => 'Mã danh mục'
        ];
    }
    
}
