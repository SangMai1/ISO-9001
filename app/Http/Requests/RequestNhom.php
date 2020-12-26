<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestNhom extends FormRequest {

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
            'ma' => 'required|string|min:1',
            'ten' => 'required|string|min:3'
        ];
    }

    public function attributes()
    {
        return [
            'ma' => 'Mã nhóm',
            'ten' => 'Tên nhóm'
        ];
    }
}