<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'original' => 'required|numeric|gt:sale',
            'sale' => 'required|numeric|gt:0',
        ];
    }
    public function messages()
    {
        return [
            'original.required' => 'Giá sản phẩm không được để trống !',
            'original.numeric' => 'Gía sản phẩm phải điền số !',
            'original.gt:sale' => 'Gía sản phẩm phải lớn hơn giá sale !',
            'sale.required' => 'Giá giảm giá không được để trống !',
            'sale.numeric' => 'Gía sản phẩm phải điền số !',
            'sale.gt:0' =>'Gía sản phẩm phải lớn hơn 0',
        ];
    }
}
