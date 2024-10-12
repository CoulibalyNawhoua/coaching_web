<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnexionRequest extends FormRequest
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
            'phone' => 'required|exists:inscriptions',
            'password' => ['required', 'regex:/^[0-9]{5}$/']
        ];
    }

    public function messages()
    {

        return [
            // vos identifiant sont incorrect
            'phone.required' => 'Le numero de téléphone est obligatoire',
            'phone.unique' => 'Ce numero de téléphone est déjà utilisé',

            'password.required' => 'Le mot de passe est obligatiore.',
            'password.regex:/^[0-9]{5}$/' => 'Le mot de passe doit contenir au moins :5 chiffres.',
        ];
    }
}