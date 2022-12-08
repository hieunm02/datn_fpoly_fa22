<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            'name' => 'required|min:2|max:16',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thuộc tính không được để trống',
            'name.min' => 'Tên thuộc tính không ít hơn 2 ký tự',
            'name.max' => 'Tên thuộc tính không nhiều hơn 16 ký tự',
            // 'name.exits' => 'Thuộc tính đã tồn tại'
        ];
    }
}
