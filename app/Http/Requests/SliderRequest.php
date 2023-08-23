<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name'  => 'required|unique:slider,name,'.$this->segment(4).',id',
            'url'   => 'required',
            'img'   =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>  'Tên slider không được phép bỏ trống',
            'name.unique'   =>  'Tên slider không được phép trùng',
            'url.required'  =>  'Liên kết không được phép bỏ trống',
            'img.image'     =>  'Tệp tin không hợp lệ',
            'img.required'     =>  'Hình ảnh không được phép bỏ trống',
            'img.mimes'     =>  'Hình ảnh có định dạng không hợp lệ',
            'img.max'       =>  'Hình ảnh có kích thước quá lớn'
        ];
    }
}
