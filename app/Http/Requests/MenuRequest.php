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
            'name'  => 'required|unique:menu,name,'.$this->segment(4).',id',
            'img'   =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>  'Tên menu không được phép bỏ trống',
            'name.unique'   =>  'Tên menu không được phép trùng',
            'img.image'     =>  'Tệp tin không hợp lệ',
            'img.mimes'     =>  'Hình ảnh có định dạng không hợp lệ',
            'img.max'       =>  'Hình ảnh có kích thước quá lớn'
        ];
    }
}
