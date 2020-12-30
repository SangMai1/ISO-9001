<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestXe extends FormRequest {

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
            'bienso' => 'required|string|min:3',
            'socho' => 'required|string|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'bienso' => 'Biển số',
            'socho' => 'Số chỗ'
        ];
    }
}