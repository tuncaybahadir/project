<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Versions;
use Illuminate\Validation\Factory as ValidationFactory;

class CreateVersionRequest extends Request {

    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'versionCheck',
            function ($attribute, $value, $parameters) {
                $versionCount = Versions::whereProjectId($parameters[0])
                    ->where($attribute, '=', $value)
                    ->count();

                return $versionCount < 1;
            },
            'Lütfen Girmiş Olduğunuz Sürüm Numarasını Kontrol Ediniz.'
        );

    }

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
            'version' => 'required|versionCheck:'. $this->input('project_id')
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'Lütfen Proje Seçiminizi Kontrol Ediniz',
            'version.required' => 'Lütfen Versiyon Numarasını Yazınız '
        ];
    }

}
