<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestAluno extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'form_name_codigo' => 'required|'.Rule::unique('cursos', 'cod_curso')->where('cod_curso', $this->form_name_codigo),
        ];
    }

    public function messages()
    {
        return [
            'required'   =>  'Deve-se preencher todos os campos para continuar',
            'form_name_codigo.unique' => 'Código já cadastrado no sistema.',
        ];
    }
}
