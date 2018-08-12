<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

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
            'role' => 'required',
            'active' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Lütfen Adınızı Yazınız',
            'role.required' => 'Lütfen Yetki Alanını Seçiniz ',
            'active.required' => 'Lütfen Editör Durumunu Seçiniz '
        ];
    }
}
