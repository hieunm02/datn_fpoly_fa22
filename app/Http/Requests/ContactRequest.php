<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0][0-9\s\-\+\(\)]*)$/|digits_between:10,11',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email sai định dạng!',
            'phone.required' => 'Vui lòng nhập số điện thoại!',
            "phone.regex" => "Số điện thoại phải là số (0xxxxxxxxxx)!",
            "phone.digits_between" => "Số điện thoại có độ dài từ 10 - 11 kí tự!",
            'content.required' => 'Mô tả không được để trống!',
        ];
    }
}
