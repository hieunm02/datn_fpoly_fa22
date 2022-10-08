<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlidesRequest extends FormRequest
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
            'product_id' => 'required',
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống!',
            'name.max' => 'Tên danh mục không quá 50 kí tự!',
            'product_id.required' => 'Sản phẩm không được để trống.',
            'url.required' => 'Url không được để trống.'
        ];
    }
}