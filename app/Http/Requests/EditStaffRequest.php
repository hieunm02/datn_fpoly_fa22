<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStaffRequest extends FormRequest
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
        return [
            'name' => 'required|max:50|min:2',
            'phone' => 'required|regex:/^([0][0-9\s\-\+\(\)]*)$/|digits_between:10,11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhân viên không được để trống!',
            'phone.required' => 'Số điệnh thoại nhân viên không được để trống!',
            "phone.regex" => "Số điện thoại phải là số (0xxxxxxxxxx)!",
            "phone.digits_between" => "Số điện thoại có độ dài từ 10 - 11 kí tự!",
            'name.max' => 'Tên nhân viên không quá 50 kí tự!',
            'name.max' => 'Tên nhân viên không ít hơn 2 kí tự!',
        ];
    }
}
