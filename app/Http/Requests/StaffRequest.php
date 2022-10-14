<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'email' => 'required|email',
            'image_path' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên nhân viên không được để trống!',
            'name.max' => 'Tên nhân viên không quá 50 kí tự!',
            'name.max' => 'Tên nhân viên không ít hơn 2 kí tự!',
            'email.required' => 'Email nhân viên không được để trống!',
            'email.email' => 'Email sai định dạng',
            'image_path.required' => 'Ảnh không được để trống!',
        ];
    }
}
