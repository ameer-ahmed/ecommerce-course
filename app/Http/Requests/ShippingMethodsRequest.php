<?php

namespace EcommerceCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodsRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required',
            'plain_value' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'حدث خطأ أثناء حفظ التعديلات.',
            'id.exists' => 'حدث خطأ أثناء حفظ التعديلات.',
            'value.required' => 'الحقل مطلوب.',
            'plain_value.numeric' => 'الحقل يقبل قيمة رقمية فقط.',
        ];
    }
}
