<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorsRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100|',
            'mobile' => 'required|max:50|unique:vendors,mobile,'.$this->id,
            'email' => 'required|email|unique:vendors,email,'.$this->id,
            'category_id' => 'required|exists:main_categories,id',
            'address'=> 'required|string|max:500',
            'password' => 'required_without:id'
        ];
    }

    public function messages()
    {   return [
        'required' => 'هذا الحقل مطلوب',
        'max' => 'هذا الحقل طويل ',
        'category_id.exists' => 'القسم غير موجود ',
        'email.email' => 'صيغه البريد الالكتروني غير صحيحه',
        'address.string' => 'العنوان لابد ان يكون حروف او ارقام' ,
        'name.string' => 'الاسم لابد ان يكون حروف او ارقام' ,
        'photo.required.without' => 'الصوره مطلوبه'

    ];

    }
}
