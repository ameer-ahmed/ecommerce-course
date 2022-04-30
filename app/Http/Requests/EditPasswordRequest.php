<?php

namespace EcommerceCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required|check_password:admin',
            'password' => 'required|min:8|confirmed|not_old_password:admin',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'هذا الحقل مطلوب.',
            'current_password.check_password' => 'كلمة المرور خطأ.',
            'password.required' => 'هذا الحقل مطلوب.',
            'password.min' => 'يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
            'password.not_old_password' => 'كلمة المرور متطابقة مع كلمة المرور الحالية.',
            'password_confirmation.required' => 'هذا الحقل مطلوب.',
        ];
    }
}
