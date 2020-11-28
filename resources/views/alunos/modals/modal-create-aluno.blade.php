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
        <div class="modal-body row">
          <p class="text-danger text-center col-12" id="error_modal_aluno"></p>
          <div class="col-6">         
            <input type="text" id="aluno_id_edit" name="aluno_id_edit" hidden >
            <label for="">Nome</label>
            <input type="text" class="form-control" name="form_name_aluno" id="form_name_aluno">
            <label for="form_name_codigo">Código do Aluno</label>
            <input type="text" class="form-control" name="form_name_codigo" id="form_name_codigo">
            <label for="form_name_situacao">Situação Aluno</label>
            <select type="text" class="form-control"  style="width: 100%" name="form_name_situacao" id="form_name_situacao"></select>
            <label for="form_name_curso">Curso</label>
            <select type="text" class="form-control" style="width: 100%" name="form_name_curso" id="form_name_curso"></select>
            <label for="form_name_turma">Turma</label>
            <input type="text" class="form-control" name="form_name_turma" id="form_name_turma">
            <label for="form_name_dt">Data da Mátricula</label>
            <input type="text" class="form-control" name="form_name_dt" id="form_name_dt">
            {{-- <label for="avatar">Escolha a imagem:</label> 
            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"> --}}
            
          </div>
          <div class="col-6">
            <input type="text" id="endereco_id_edit" name="endereco_id_edit" hidden >
            <label for="form_name_cep">Cep</label>
            <input type="text" class="form-control" name="form_name_cep" id="form_name_cep">
            <label for="">Rua</label>
            <input type="text" class="form-control" readonly name="form_name_rua" id="form_name_rua">
            <label for="form_name_rua">Bairro</label>
            <input type="text" class="form-control" readonly name="form_name_bairro" id="form_name_bairro">
            <label for="form_name_cidade">Cidade</label>
            <input type="text" class="form-control" readonly  style="width: 100%" name="form_name_cidade" id="form_name_cidade">
            <label for="form_name_estado">Estado</label>
            <input type="text" class="form-control" readonly  style="width: 100%" name="form_name_estado" id="form_name_estado">
            <label for="form_name_numero">Número</label>
            <input type="text" class="form-control" style="width: 100%" name="form_name_numero" id="form_name_numero">
            <label for="form_name_comp">Complemento</label>
            <input type="text" class="form-control" style="width: 100%" name="form_name_comp" id="form_name_comp">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-outline-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>