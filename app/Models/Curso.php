<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    
    public static function autoComplete($request){
        return self::selectRaw('cursos.name as text')
        ->selectRaw('cursos.id as id')
        ->where('cursos.name', 'like', '%'.$request->input('q').'%')
        ->orderBy('cursos.name')
        ->get()
        ->toArray();
    }

    public static function getCurso($id){
        return self::selectRaw('cursos.name, cursos.cod_curso')
        ->selectRaw('cursos.id as id')
        ->where('cursos.id', $id)
        ->first();
    }
}
