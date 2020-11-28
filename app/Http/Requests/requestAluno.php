<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestAluno extends FormRequest
{
    public function rules()
    {
        return [
            'form_name_aluno' => 'required',
            'form_name_codigo' => 'required',
            'form_name_situacao' => 'required',
            'form_name_curso' => 'required',
            'form_name_turma' => 'required',
            'form_name_dt' => 'required',
            'form_name_cep' => 'required',
            'form_name_rua' => 'required',
            'form_name_bairro' => 'required',
            'form_name_cidade' => 'required',
            'form_name_estado' => 'required',
            'form_name_numero' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'   =>  'Deve-se preencher todos os campos para continuar',
        ];
    }
}
