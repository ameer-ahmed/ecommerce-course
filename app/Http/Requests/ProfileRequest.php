<?php

namespace EcommerceCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.auth('admin')->user()->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب.',
            'email.required' => 'هذا الحقل مطلوب.',
            'email.email' => 'الصيغة غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',
        ];
    }

}
