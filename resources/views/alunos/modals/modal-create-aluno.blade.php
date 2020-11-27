<div class="modal fade" id="modal-aluno-create" tabindex="-1" role="dialog" aria-labelledby="modal-aluno-create" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-aluno-create">Cadastrar Aluno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-aluno-create" action="">
        <div class="modal-body">
          <label for="">Nome</label>
          <input type="text" class="form-control" name="form-name-aluno" id="form-name-aluno">
          <label for="form-name-codigo">Código do Aluno</label>
          <input type="text" class="form-control" name="form-name-codigo" id="form-name-codigo">
          <label for="form-name-cep">Cep</label>
          <input type="text" class="form-control" name="form-name-cep" id="form-name-cep">
          <label for="form-name-situacao">Situação Aluno</label>
          <select type="text" class="form-control"  style="width: 100%" name="form-name-situacao" id="form-name-situacao"></select>
          <label for="form-name-curso">Curso</label>
          <select type="text" class="form-control" style="width: 100%" name="form-name-curso" id="form-name-curso"></select>
          <label for="form-name-turma">Turma</label>
          <input type="text" class="form-control" name="form-name-turma" id="form-name-turma">
          <label for="form-name-dt">Data da Mátricula</label>
          <input type="text" class="form-control" name="form-name-dt" id="form-name-dt">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-outline-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>