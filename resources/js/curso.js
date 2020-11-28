
$(document).ready(function(){
  dropzoneCreate()
  datatableCursos()
  ajaxSubmitCurso()
  $('#success_modal, #modal_error').on('hidden.bs.modal', function (e) {
    location.reload()
  })

})

function ajaxSubmitCurso(){
  $("#form-curso-create").submit(function(e){
    e.preventDefault()
    $('#loading').modal('show');
    $('#modal-curso-create').modal('hide')
    $.ajax({
      type:'post',
      url:'/salvarCurso',
      data:$("#form-curso-create").serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: true,
      success(response){
        $('#loading').modal('hide');
        if(response.code){            
          $('#modal-error').modal('show')
          $('.frase_up').text(response.message)
        }else{
          $('#error_modal_curso').html('')
          $('#success_modal').modal('show')
          $('.frase_up').text(response.message)
        }
      },error(response){
        $('#modal-curso-create').modal('show')
        $('#loading').modal('hide');
        if(response.status === 422){
          var obj = response.responseJSON.errors;
          if(obj.hasOwnProperty('form_codigo_curso')){
            var html ='';
            for(index in obj.form_codigo_curso){
              html += '<span>'+obj.form_codigo_curso[index]+'</span> <br>'
            }
            $('#error_modal_curso').html(html)
          }else{
            var html ='';
            for(index in obj.form_curso){
              html += '<span>'+obj.form_curso[index]+'</span> <br>'
            }
            $('#error_modal_curso').html(html)
            
          }
          
        }
      }
    });
  })
}

function dropzoneCreate(){
  $("#dropzoneForm").dropzone({
    maxFilesize: 2,
    maxFiles:1,
    parallelUploads: 1,
    url: "/upload-xml",
    acceptedFiles:".xml",
    dictDefaultMessage: '<i class="fas fa-upload fa-2x mb-2"></i><p>Solte o documento aqui ou clique para fazer o upload.</p>',
    dictFileTooBig: 'Arquivo é maior que o permitido (2MB)',
    dictInvalidFileType: 'Arquivo Inválido!',
    dictMaxFilesExceeded: 'Quantidade máxima de upload de arquivos excedido',
    autoProcessQueue: true,
    addRemoveLinks:true,
    dictRemoveFile: 'Remover',
    success: function (response) {
      $('#modal-xml-create').modal('hide')
      $('#success_modal').modal('show')
      $(".frase_up").text('Cursos cadatrados com sucesso!')
    },
    error: function(response){
      $('#modal-xml-create').modal('hide')
      if(response.status == "error"){
        if(response.size > 2000000)
        $(".frase_up").text('Erro ao enviar arquivo! O arquivo deve ter no máximo 2mb!');  
      }
      else if(response.xhr && response.xhr.status == 401)
      $(".frase_up").text('Erro ao enviar arquivo! Arquivo duplicado!');
      else
      $(".frase_up").text('Erro ao enviar arquivo! Formato incorreto!');
      
      $('#modal-error').modal('show');
    }
  });
}

function datatableCursos(){
  $('#cursos_id').DataTable().destroy();
  $('#cursos_id'+' tbody').empty();
  window.table = $('#cursos_id').DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
    },
    processing: true,
    "bLengthChange" : false,
    "serverSide": false,
    "orderable": false,
    "ajax": {
      url: "/datatableCursos"
    },
    "search": true,
    columns: [
      { data: 'cod_curso', name: 'cod_curso', width: '30px'},
      { data: 'name', name: 'name'},
      { data: 'button', name: 'button'},
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [ 0, 1,2] },
      { "bSearchable": false, "aTargets": [ 0, 1,2] }
    ],
    order: [],
    "pageLength": 999 ,
    drawCallback: function(settings) {
      editCurso()
      excluirCurso()
    }
  })
}

function editCurso(){
  $('.curso_edit').click(function(){
    $('#loading').modal('show');
    $.ajax({
      type:'get',
      url:'/getCurso',
      data: {
        id : $(this).data('id')
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: true,
      success(response){
        $('#loading').modal('hide')
        $('#modal-curso-create').modal('show')
        $('#form_curso').val(response.name)
        $('#form_codigo_curso').val(response.cod_curso)
        $('#curso_id_edit').val(response.id)
      }
    }); 
  })
}

function excluirCurso(){
  $('.curso_trash').click(function(){
    $('#loading').modal('show');
    $.ajax({
      type:'delete',
      url:'/deleteCurso',
      data: {
        id : $(this).data('id')
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: true,
      success(response){
        location.reload()
      }
    }); 
  })
}