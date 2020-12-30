<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLichXuatXe extends FormRequest {

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
            'thoigiandidukien' => 'required',
            'thoigianvedukien' => 'required|',
            'diadiemdi' => 'required|string|min:1',
            'ghichu' => 'required|string|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'thoigiandidukien' => 'Thời gian đi dự kiến',
            'thoigianvedukien' => 'Thời gian về dự kiến',
            'diadiemdi' => 'Thòi gian đi',
            'ghichu' => 'Ghi chú'
        ];
    }
}