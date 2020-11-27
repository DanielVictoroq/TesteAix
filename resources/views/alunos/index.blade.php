@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header align-items-center d-flex justify-content-between">{{ __('Alunos') }}<a class="btn btn-outline-primary float-right" href="##" data-toggle="modal" data-target="#modal-aluno-create">{{ __('Novo Aluno') }}</a></div>
        
        <div class="card-body">
          <table id="alunos_id" class="table table-bordered text-center">
            <thead>
              <th>Aluno</th>
              <th>Código do Aluno</th>
              <th>Situação Aluno</th>
              <th>Cep</th>
              <th>Rua</th>
              <th>Numero</th>
              <th>Complemento</th>
              <th>Bairro</th>
              <th>Cidade</th>
              <th>Estado</th>
              <th>Curso</th>
              <th>Turma</th>
              <th>Data da Mátricula</th>
              <th>#</th>
            </thead>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection