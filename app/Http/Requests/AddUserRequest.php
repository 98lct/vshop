<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'     =>  'required|unique:users,email|max:255',
            'img'       =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'  =>  'required|min:6|max:32',
            'password_confirm'  =>'required|min:6|max:32|same:password',
        ];
    }
    public function messages()
    {
        return [
            'email.required'    => 'Email Không Được Để Trống',
            'email.unique'      => 'Email Đã Tồn Tại',
            'img.image'         => 'Hình không đúng định dạng ',
            'img.max'           => 'Hình ảnh kích thước quá lớn'
        ];
    }
}
