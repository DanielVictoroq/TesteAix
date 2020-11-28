<div class="modal fade" id="modal-curso-create" tabindex="-1" role="dialog" aria-labelledby="modal-curso-create" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-curso-create" action="">
        <div class="modal-body">
          <p class="text-danger text-center" id="error_modal_curso"></p>
          <input type="text" id="curso_id_edit" name="curso_id_edit" hidden>
          <label for="form_curso">Nome</label>
          <input type="text" class="form-control" name="form_curso" id="form_curso">
          <label for="form_codigo_curso">Código do Curso</label>
          <input type="text" class="form-control" name="form_codigo_curso" id="form_codigo_curso">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-outline-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>