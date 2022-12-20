<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|regex:/^([0][0-9\s\-\+\(\)]*)$/|digits_between:10,11',
            'email' => 'required|email',
            'product_id' => 'required',
            'building' => 'required',
            'floor' => 'required',
            'room' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên',
            'phone.required' => 'Vui lòng điền số điện thoại',
            "phone.regex" => "Số điện thoại phải là số (0xxxxxxxxxx)!",
            "phone.digits_between" => "Số điện thoại có độ dài từ 10 - 11 kí tự!",
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không đúng định dạng',
            'product_id.required' => 'Vui lòng chọn sản phẩm cần thanh toán',
            'building.required' => 'Vui lòng chọn tòa',
            'floor.required' => 'Vui lòng chọn tầng',
            'room.required' => 'Vui lòng chọn phòng',
        ];
    }
}
