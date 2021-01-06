<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestChucNang extends FormRequest
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
            'ten' => 'required|string|min:5',
            'url' => 'required|regex:/^\\/[^\\?^\\s]*$/|unique:chucnangs,url'
        ];
    }

    public function attributes()
    {
        return [
            'ten' => 'Tên chức năng',
            'url' => 'Đường dẫn URL'
        ];
    }
    
}
