<?php

namespace App\Http\Controllers;

use App\Http\Requests\requestCurso;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Curso;
use Exception;
use Storage;
class CursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('cursos.index');
    }
    
    public function uploadXmlCursos(Request $request){
        
        $xml = json_decode(json_encode(simplexml_load_file( $request->file('file'))));
        foreach($xml->curso as $item){
            $curso = Curso::where('cod_curso', $item->codigo)->first();
            if(!$curso){
                $curso = new Curso;
                $curso->name = $item->nome;
                $curso->cod_curso = $item->codigo;
                $curso->save();
            }
        }
        return true;
    }
    public function getCurso(Request $request){
        return Curso::getCurso($request->input('id'));
    }

    public function salvarCurso(requestCurso $request){
        if($request->input('curso_id_edit')){
            $curso = Curso::find($request->input('curso_id_edit'));
        }else{
            $curso = Curso::where('cod_curso', $request->input('form_codigo_curso'))->first();
            if($curso){
                return ['code' => 1, 'message' => 'Código já cadastrado'];
            }
            $curso = new Curso;
        }
        $curso->name = $request->input('form_name_curso');
        $curso->cod_curso = $request->input('form_codigo_curso');
        try{
            $curso->save();
            return ['message'=> 'Curso cadastrado com sucesso!'];
        }catch(Exception $e){
            return ['code' => 1, 'message' => 'Erro ao cadastrar curso'];
        }
    }

    public function deleteCurso(Request $request){
        return Curso::destroy($request->input('id'));
    }
    
    public function datatableCursos(Request $request)
    {
        return DataTables::of(Curso::orderBy('cod_curso')->get())
        ->addColumn('button' , function($item){
            $html = '<button data-id="'.$item->id.'" class="btn curso_edit mt-0 mb-0 pt-0 pb-0 pl-1 pr-1" type="button"><i class="fas fa-pen"></i></button>';
            $html .= '<button data-id="'.$item->id.'" class="btn curso_trash mt-0 mb-0 pt-0 pb-0 pl-1 pr-1 text-danger" type="button"><i class="fas fa-times"></i></button>';
            return $html;
        })
        ->escapeColumns('button')
        ->make(true);
    }
    public function autoComplete(Request $request){
        return Curso::autoComplete($request);
    }
    
}
