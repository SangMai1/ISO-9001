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
            'bienso' => 'required|string|min:5|unique:xes,id,'.$this->id,
            'socho' => 'required|numeric|min:0|not_in:0'
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