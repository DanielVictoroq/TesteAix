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
        return self::selectRaw('alunos.id as id, alunos.name, alunos.cod_aluno, alunos.dtmatricula')
        ->selectRaw('endereco.cep, endereco.rua, endereco.numero, endereco.complemento, endereco.bairro, endereco.cidade, endereco.estado')
        ->selectRaw('situacao_aluno.situacao')
        ->selectRaw('cursos.name as curso')
        ->selectRaw('turmas.turma')
        ->join('endereco', 'endereco.id', 'alunos.endereco_id')
        ->join('situacao_aluno', 'situacao_aluno.id', 'alunos.situacao_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->join('turmas', 'turmas.id', 'alunos.turma')
        ->get();
    }
}
