@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header align-items-center d-flex justify-content-between">{{ __('Alunos') }}<a class="btn btn-outline-primary float-right" href="##" data-toggle="modal" data-target="#modal-aluno-create">{{ __('Novo Aluno') }}</a></div>
        
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection