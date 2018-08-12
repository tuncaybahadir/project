<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateValueRequest extends Request {

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
            'project_id' => 'required',
            'version_id' => 'required',
            'lang' => 'required',
            'key' => 'required',
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'Lütfen Proje Seçiminizi Kontrol Ediniz',
            'version_id.required' => 'Lütfen Versiyon Seçiminizi Kontrol Ediniz',
            'lang.required' => 'Lütfen Dil Seçiniz',
            'key.required' => 'Lütfen Key Yazınız',
            'value.required' => 'Lütfen Value Yazınız.'
        ];
    }

}
