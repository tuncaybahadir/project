<?php namespace App\Http\Requests;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends Request
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
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

            return Hash::check($value, current($parameters));

        });

        return [
            'old_password' => 'required|old_password:' . Auth::user()->password,
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'old_password' => 'Eski Şifrenizi Yanlış Girdiniz.',
            'old_password.required' => 'Lütfen Eski Şifrenizi Yazınız.',
            'new_password.required' => 'Lütfen Yeni Şifrenizi Yazınız.',
            'new_password_confirmation.required' => 'Lütfen Yeni Şifrenizi Tekrar Yazınız.',
            'confirmed' => 'Yeni Şifreniz ile Yeni Şifre Tekrarı Uyuşmuyor',
        ];
    }
}
