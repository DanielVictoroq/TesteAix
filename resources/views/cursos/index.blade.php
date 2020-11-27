@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Cursos') }} 
          <div class="float-right">
            <a class="btn btn-outline-primary mr-3" href="##" data-toggle="modal" data-target="#modal-curso-create">{{ __('Cadastrar Curso') }}</a>
            <a class="btn btn-outline-primary" href="##" data-toggle="modal" data-target="#modal-xml-create">{{ __('Importar XML') }}</a>
          </div>
        </div>
        
        <div class="card-body">
          <table id="cursos_id" class="table table-bordered text-center">
            <thead>
              <th>Código</th>
              <th>Curso</th>
              <th>#</th>
            </thead>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@include('layouts.modals.modal-success')
@include('layouts.modals.modal-error')