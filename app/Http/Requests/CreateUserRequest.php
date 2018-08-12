<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'active' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Lütfen Adınızı Yazınız',
            'email.required' => 'Lütfen Mail Adresinizi Yazınız',
            'email.email' => 'Lütfen Geçerli bir mail adresi Yazınız',
            'email.unique' => 'Girdiğiniz mail adresi daha önceden kullanılmış',
            'role.required' => 'Lütfen Yetki Alanını Seçiniz ',
            'active.required' => 'Lütfen Editör Durumunu Seçiniz ',
            'password.required' => 'Lütfen Yeni Şifrenizi Yazınız.',
            'password.min' => 'Yeni Şifreniz en az :min karakterden oluşmalıdır',
            'password_confirmation.required' => 'Lütfen Yeni Şifrenizi Tekrar Yazınız.',
            'password_confirmation.min' => 'Yeni Şifre Tekrar en az :min karakterden oluşmalıdır',
            'confirmed' => 'Yeni Şifreniz ile Yeni Şifre Tekrarı Uyuşmuyor',
        ];
    }

}
