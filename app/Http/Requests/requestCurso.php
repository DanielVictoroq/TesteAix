<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class requestCurso extends FormRequest
{
    
    public function rules()
    {
        
        return [
            'form_codigo_curso' => 'required',
            'form_curso' => 'required',
        ];
        
    }
    
    public function messages()
    {
        return [
            'required' =>  'Deve-se preencher todos os campos para continuar',
            // 'form_codigo_curso.unique' => 'Código já cadastrado no sistema.',
        ];
    }
}
