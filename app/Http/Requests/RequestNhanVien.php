<?php

namespace App\Http\Requests;

use App\Models\ChucDanh;
use App\Models\PhongBan;
use App\Util\CommonUtil;
use Illuminate\Console\Command;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RequestNhanVien extends FormRequest
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
        $isCreate = Request::getPathInfo() == route('nhanvien.create');
        return  [
            'ten' => 'required|string',
            'email' => 'required|email',
            'phongbanid' => ['nullable', CommonUtil::checkExists(PhongBan::class)],
            'chucdanhid' => ['nullable', CommonUtil::checkExists(ChucDanh::class)],
            'password' => 'required|min:8',
            'username' => [$isCreate ? 'required' : 'nullable', 'min:6'],
            
        ];
    }

    public function attributes()
    {
        return [
            'ten' => 'Tên nhân viên',
        ];
    }
    
}
