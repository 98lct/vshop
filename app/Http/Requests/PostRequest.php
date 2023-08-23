<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|unique:post,title,'.$this->segment(4).',id|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required',
            'type'  =>'required',
            'detail'=>'required',
            'describe'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tên Loai Không Được Để Trống',
            'title.unique' => 'Tên Loai Đã Tồn Tại',
            'title.max' => 'Ký Tự Không Vượt Quá 255',
            'slug.required' => 'Slug Không Được Để Trống',
            'img.mimes' => 'Tệp Tin Không Hổ Trợ',
            'img.max' => 'Kích Thước Quá Lớn',
            'img.image' => 'Không Là Ảnh',
            'type.required'=>'Chưa Chọn Loại Bài Viết',
            'detail.required'=>'Chi Tiết Bài Viết Không Được Bỏ Trống',
            'describe.required'=>'Mô Tả Bài Viết Không Được Bỏ Trống',
        ];
    }
}
