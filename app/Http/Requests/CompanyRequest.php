<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'name'      => ['required' , 'max:191' , 'string'],
            'email'     => [
                'required' , 'email' ,
                $this->isMethod('post')
                    ? (Rule::unique('companies'))
                    : (Rule::unique('companies')->ignore($this->company->id))
            ],
            'website_url'  => ['required' , 'url'],
            'logo'     => ['nullable' , 'mimes:jpg,png,jpeg' , 'dimensions:min_width=100,min_height=100']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' =>false,
                'message'=>$errors = $validator->errors()

            ], 422)
        );
    }
}
