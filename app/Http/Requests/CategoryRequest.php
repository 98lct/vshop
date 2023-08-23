<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:category,name,'.$this->segment(4).',id|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Loai Không Được Để Trống',
            'name.unique' => 'Tên Loai Đã Tồn Tại',
            'name.max' => 'Ký Tự Không Vượt Quá 255',
            'slug.required' => 'Slug Không Được Để Trống',
            'img.mimes' => 'Tệp Tin Không Hổ Trợ',
            'img.max' => 'Kích Thước Quá Lớn',
            'img.image' => 'Không Là Ảnh'
        ];
    }
    
}
