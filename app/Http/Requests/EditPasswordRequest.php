<?php

namespace EcommerceCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:8|confirmed|exclude',
            'password_confirmation' => 'required|exclude',
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
            'password_confirmation.required' => 'هذا الحقل مطلوب.',
        ];
    }
}
