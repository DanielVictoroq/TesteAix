<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    public static function autoCompleteSituacao($request){
        return self::selectRaw('situacao_aluno.situacao as text')
        ->selectRaw('situacao_aluno.id as id')
        ->from('situacao_aluno')
        ->where('situacao_aluno.situacao', 'like', '%'.$request->input('q').'%')
        ->get()
        ->toArray();
    }

    public static function getAlunos(){
        return self::selectRaw('alunos.id as id, alunos.name, alunos.cod_aluno,date_format(alunos.dtmatricula, "%d/%m/%Y") as dtmatricula, alunos.endereco_id')
        ->selectRaw('enderecos.cep, enderecos.rua, enderecos.numero, enderecos.complemento, enderecos.bairro, enderecos.cidade, enderecos.estado')
        ->selectRaw('situacao_aluno.situacao, alunos.situacao_id, alunos.curso_id')
        ->selectRaw('cursos.name as curso')
        ->selectRaw('alunos.turma')
        ->join('enderecos', 'enderecos.id', 'alunos.endereco_id')
        ->join('situacao_aluno', 'situacao_aluno.id', 'alunos.situacao_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->get();
    }
    public static function getAluno($id){
        return self::selectRaw('alunos.id as id, alunos.name, alunos.cod_aluno, date_format(alunos.dtmatricula, "%d/%m/%Y") as dtmatricula, alunos.endereco_id')
        ->selectRaw('enderecos.cep, enderecos.rua, enderecos.numero, enderecos.complemento, enderecos.bairro, enderecos.cidade, enderecos.estado')
        ->selectRaw('situacao_aluno.situacao, alunos.situacao_id, alunos.curso_id')
        ->selectRaw('cursos.name as curso')
        ->selectRaw('alunos.turma')
        ->join('enderecos', 'enderecos.id', 'alunos.endereco_id')
        ->join('situacao_aluno', 'situacao_aluno.id', 'alunos.situacao_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->where('alunos.id', $id)
        ->first();
    }
}
