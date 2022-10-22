<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'phone' => 'required|regex:/^([0-9\-\+]*)$/|min:10'
        ];
    }
    public function messages()
    {
        return[
            'phone.required' => 'Không bỏ trống số điện thoại',
            'phone.min' => 'Số điện thoại không ít hơn 10 số',
            'phone.regex' => 'Không hợp lệ'
        ];
    }
}
