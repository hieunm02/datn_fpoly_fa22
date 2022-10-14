<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        if ($this->route('news')) {
            return [
                'title' => 'required|min:6|unique:news,title,' . $this->route('news'),
                'short_desc' => 'required',
                'content' => 'required',
            ];
        }
        
        return [
            'title' => 'required|unique:news|min:6',
            'short_desc' => 'required',
            'content' => 'required',
            'image_path' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề bài viết không được để trống!',
            'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
            'title.min' => 'Tiêu đề bài viết phải lớn hơn 6 kí tự!',
            'short_desc.required' => 'Mô tả ngắn không được để trống!',
            'content.required' => 'Mô tả ngắn không được để trống!',
        ];
    }
}
