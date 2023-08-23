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
        return [
            'name' => 'required|unique:product,name,'.$this->segment(4).',id|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:product,slug,'.$this->segment(4).',id',
            'detail' => 'required',
            'describe' => 'required',
            'number' => 'required|numeric',
            'price' => 'required|numeric',
            'pricesale' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên SP Không Được Để Trống',
            'name.unique' => 'Tên SP Đã Tồn Tại',
            'name.max' => 'Ký Tự Không Vượt Quá 255',
            'slug.required' => 'Slug Không Được Để Trống',
            'img.mimes' => 'Tệp Tin Không Hổ Trợ',
            'img.max' => 'Kích Thước Quá Lớn',
            'img.image' => 'Không Là Ảnh',
            'describe'  => 'Mô tả không được để trống',
            'price.required'=> 'Giá SP không được để trống',
            'price.numeric'=>'Giá SP không phù hợp',
            'pricesale.required'=>'Giá KM không được để để trống',
            'detail.required'=>'Chi Tiết SP không được để trống',
            'pricesale.numeric'=>'Giá KM không phù hợp'
        ];
    }
}
