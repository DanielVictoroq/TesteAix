<div class="modal fade" id="modal-xml-create" tabindex="-1" role="dialog" aria-labelledby="modal-xml-create" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importar Xml</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="dropzone" id="dropzoneForm" action="{{url('/upload-arquivos')}}" method="POST" enctype="multipart/form-data">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>