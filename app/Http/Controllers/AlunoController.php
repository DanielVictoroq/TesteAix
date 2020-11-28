<?php

namespace App\Http\Controllers;
use App\Http\Requests\requestAluno;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Aluno;
use Storage;
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
    public function uploadImagens(Request $request){
        
        $file  = $request->file('file');
        $fileName  = $request->file('file')->getClientOriginalName();

        $aluno = Aluno::find($request->input('id_aluno'));
        
        $arq = Storage::disk('local')->putFileAs('/public/'.$aluno->id, $file,$fileName  );
        $aluno->path_image = storage_path($arq);
        try{
            $aluno->save();
        }catch(Exception $e){
            return ['code' => 1, 'message' => 'Erro ao inserir imagem'];
        }
        return true;
    }
    
    public function getAluno(Request $request){
        return Aluno::getAluno($request->input('id'));
    }
    
    public function salvarAluno(requestAluno $request){
        if($request->input('aluno_id_edit')){
            $aluno = Aluno::find($request->input('aluno_id_edit'));
            $endereco = Endereco::find($request->input('endereco_id_edit'));
        }else{
            $aluno = new Aluno;
            $endereco = new Endereco;
        }
        
        $endereco->cep = $request->input('form_name_cep');
        $endereco->rua = $request->input('form_name_rua');
        $endereco->bairro = $request->input('form_name_bairro');
        $endereco->cidade = $request->input('form_name_cidade');
        $endereco->estado = $request->input('form_name_estado');
        $endereco->numero = $request->input('form_name_numero');
        $endereco->complemento = $request->input('form_name_comp');
        try{
            $endereco->save();
        }catch(Exception $e){
            return ['code' => 1, 'message' => 'Erro ao cadastrar Endereço'];
        }
        
        $aluno->name = $request->input('form_name_aluno');
        $aluno->cod_aluno = $request->input('form_name_codigo');
        $aluno->dtmatricula = $this->invertData($request->input('form_name_dt')) ;
        $aluno->turma = $request->input('form_name_turma');
        $aluno->situacao_id = $request->input('form_name_situacao');
        $aluno->endereco_id = $endereco->id;
        $aluno->curso_id = $request->input('form_name_curso');

        try{
            $aluno->save();
            return ['message'=> 'Aluno cadastrado com sucesso!'];
        }catch(Exception $e){
            return ['code' => 1, 'message' => 'Erro ao cadastrar Aluno'];
        }
    }
    
    public function deleteAluno(Request $request){
        $aluno = Aluno::find($request->input('id'));
        $endereco = Endereco::find($aluno->endereco_id);
        $aluno->delete();
        $endereco->delete();
        return true;
    }
    
    public function datatableAlunos(Request $request)
    {
        return DataTables::of(Aluno::getAlunos())
        ->addColumn('button' , function($item){
            $html = '<button data-id="'.$item->id.'" class="btn img_upload mt-0 mb-0 pt-0 pb-0 pl-1 pr-1" type="button"><i class="far fa-image"></i></button>';
            $html .= '<button data-id="'.$item->id.'" class="btn aluno_edit mt-0 mb-0 pt-0 pb-0 pl-1 pr-1" type="button"><i class="fas fa-pen"></i></button>';
            $html .= '<button data-id="'.$item->id.'" class="btn aluno_trash mt-0 mb-0 pt-0 pb-0 pl-1 pr-1 text-danger" type="button"><i class="fas fa-times"></i></button>';
            return $html;
        })
        ->escapeColumns('button')
        ->make(true);
    }
    public function invertData($date){
        $date = explode('/', $date);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        return $date;
    }
}
