<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|min:3|max:100',
            'email' => 'required|email|unique:funcionarios',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'matricula' => 'required',
            'foto' => 'required|image'
        ];
    }

    /**
     * Get the messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(){
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está cadastrado',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
            'password_confirmation.required' => 'O campo confirmar senha é obrigatório',
            'password_confirmation.same' => 'O campo confirmar senha deve ser igual ao campo senha',
            'matricula.required' => 'O campo matrícula é obrigatório',
            'foto.required' => 'O campo foto é obrigatório',
            'foto.image' => 'O campo foto deve ser uma imagem válida'
        ];
    }

}
