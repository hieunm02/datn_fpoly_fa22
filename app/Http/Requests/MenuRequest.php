<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'parent_id' => 'required',
            'thumb' => 'required',
            'active' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống!',
            'name.max' => 'Tên danh mục không quá 50 kí tự!',
            'parent_id.required' => 'Danh muc không được để trống!',
            'thumb.required' => 'Ảnh không được để trống!',
            'active.required' => 'Trạng thái không được để trống!',
        ];
    }
}
