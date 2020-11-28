<div class="modal fade" id="modal-img-create" tabindex="-1" role="dialog" aria-labelledby="modal-img-create" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importar Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="dropzone" id="dropzoneImg" action="{{url('/upload-imagens')}}" method="POST" enctype="multipart/form-data">
          <input type="text" name="id_aluno" id="id_aluno" hidden> 
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>