<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Aluno;
class AlunoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('alunos.index');
    }
    
    public function autoCompleteSituacao(Request $request){
        return Aluno::autoCompleteSituacao($request);
    }
    public function datatableAlunos(Request $request)
    {
        return DataTables::of(Aluno::getAlunos())
        ->addColumn('button' , function($item){
            $html = '<button data-id="'.$item->id.'" class="btn aluno_edit mt-0 mb-0 pt-0 pb-0 pl-1 pr-1" type="button"><i class="fas fa-pen"></i></button>';
            $html .= '<button data-id="'.$item->id.'" class="btn aluno_trash mt-0 mb-0 pt-0 pb-0 pl-1 pr-1 text-danger" type="button"><i class="fas fa-times"></i></button>';
            return $html;
        })
        ->escapeColumns('button')
        ->make(true);
    }
}
