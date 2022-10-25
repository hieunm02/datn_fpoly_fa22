<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
        if ($this->route('voucher')) {
            return [
                'code' => 'required|min:5|unique:vouchers,code,' . $this->route('voucher'),
                'active' => 'required',
                'discount' => 'integer|required|numeric',
            ];
        }
        return [
            'code' => 'required|min:5|unique:vouchers',
            'active' => 'required',
            'discount' => 'integer|required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Code không được để trống',
            'code.min' => 'Code tối thiểu 5 kí tự',
            'code.unique' => 'Code đã tồn tại',
            'active.required' => 'Trạng thái không được để trống',
            'discount.required' => 'Giảm giá không được để trống',
            'discount.integer' => 'Giảm giá phải là số nguyên',
            'discount.numeric' => 'Giảm giá không đúng định dạng',
        ];
    }
}
