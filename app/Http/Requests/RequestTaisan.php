<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTaisan extends FormRequest {

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
            'mataisan' => 'required|string|min:1',
            'tentaisan' => 'required|string|min:3'
        ];
    }

    public function attributes()
    {
        return [
            'mataisan' => 'Mã tài sản',
            'tentaisan' => 'Tên tài sản'
        ];
    }
}