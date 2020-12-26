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
            'username' => 'required|string|min:3',
            'email' => 'required|string|min:8',
            'password' => 'required|string|min:6'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tên tài khoản',
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ];
    }
    
}
