<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InscriptionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone' => 'required|unique:inscriptions',
            'password' => [
                'required',
                'confirmed',
                'regex:/^[0-9]{5}$/',
            ],
            'password_confirmation' =>  ['required', 'regex:/^[0-9]{5}$/'],
        ];
    }
    // public function failedValidation(Validator $validator){
    //     throw new HttpResponseException(response()->json([
    //         'success'=> false,
    //         'status'=> 422,
    //         'error'=> true,
    //         'message'=> 'Erreur de validation',
    //         'errorList'=> $validator->errors()

    //     ]));
    // }
    public function messages(){

        return[

            'first_name.required' => 'Le nom est obligatoire.',
            'first_name.string' => 'Le nom doit être une chaîne de caractères.',

            'last_name.required' => 'Le prénom est obligatoire.',
            'last_name.string' => 'Le prénom doit être une chaîne de caractères.',

            'phone.required' => 'Le numero de téléphone est obligatoire',
            'phone.unique' => 'Ce numero de téléphone est déjà utilisé',

            'password.required' => 'Le mot de passe est obligatiore.',
            'password.regex:/^[0-9]{5}$/' => 'Le mot de passe doit contenir au moins :5 chiffres.',

        ];
    }
}
