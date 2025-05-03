<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

           'email' => ['required', 'email', 'max:255'] ,
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',  // كلمة المرور يجب أن تكون على الأقل 8 محارف
                'regex:/[a-z]/',  // يجب أن تحتوي على حرف صغير
                'regex:/[A-Z]/',  // يجب أن تحتوي على حرف كبير
                'regex:/[0-9]/',  // يجب أن تحتوي على رقم
                'regex:/[!@#$%^&*(),.?":{}|<>]/',  // يجب أن تحتوي على رمز خاص
            ],
        ];
    }

}
