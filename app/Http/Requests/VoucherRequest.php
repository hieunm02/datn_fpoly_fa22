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
                'discount' => 'required|numeric|min:0',
                'quantity' => 'min:0|numeric',
                'start_time' => 'date',
                'end_time' => 'date',
            ];
        }
        return [
            'code' => 'required|min:5|unique:vouchers',
            'active' => 'required',
            'discount' => 'required|numeric|min:0',
            'quantity' => 'min:0|numeric',
            'start_time' => 'date',
            'end_time' => 'date',
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
            'discount.numeric' => 'Giảm giá không đúng định dạng',
            'start_time.date' => 'Ngày nhập không đúng định dạng',
            'end_time.date' => 'Ngày nhập không đúng định dạng',
            'discount.min' => 'Giảm giá không được âm',
            'quantity.numeric' => 'Số lượng không đúng định dạng',
            'quantity.min' => 'Số lượng không được âm',
        ];
    }
}
