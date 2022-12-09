<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->route('products')) {
            return [
                'name' => 'required' . $this->route('products'),
                'content' => 'required|min:6',
                'desc' => 'required|min:6',
                'thumb' => 'required|image',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|after_or_equal:price_sales',
            ];
        }

        return [
            'name' => 'required',
            'content' => 'required|min:6',
            'desc' => 'required|min:6',
            'thumb' => 'required|image',
            'quantity' => 'required|integer|min:1',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống!',
            'content.min' => 'Mô tả ngắn phải lớn hơn 6 kí tự!',
            'content.required' => 'Mô tả ngắn không được để trống!',
            'desc.required' => 'Mô tả chi tiết không được để trống!',
            'desc.min' => 'Mô tả chi tiết phải lớn hơn 6 kí tự!',

            'thumb.image' => 'Phải là file ảnh!',
            'thumb.required' => 'Ảnh sản phẩm không được để trống!',
            'quantity.required' => 'Số lượng sản phẩm không được để trống!',
            'quantity.integer' => 'Số lượng sản phẩm phải là số! ',
            'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 1!',
            'price.required' => 'Giá sản phẩm không được để trống!'

        ];
    }
}