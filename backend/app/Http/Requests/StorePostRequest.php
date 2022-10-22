<?php

 namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Http\Exceptions\HttpResponseException;
 use Illuminate\Contracts\Validation\Validator;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $hunderYearsAgo = date("Y-m-d",strtotime("-100 year"));
        $eighteenYearsAgo = date("Y-m-d",strtotime("-18 year"));

        return [
            'name' => 'required|unique:user_mades|max:255',
            'email'=> 'required|unique:user_mades|email',
            'date_naissance'=>'required|date|before:'.$eighteenYearsAgo.'|after:'.$hunderYearsAgo
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }

}

?>
