$(document).ready(function(){
  datatableAlunos()
  ajaxSubmitAluno()
  dropzoneCreate()
  autoComplete('form_name_curso', 'Cursos', '/autoCompleteCursos', false);
  autoComplete('form_name_situacao', 'Situação', '/autoCompleteSituacao', false);
  $('#form_name_cep').change(function(){
    viaCepAjax()
  })
  $("#form_name_cep").mask('99.999-999')
  $("#form_name_dt").mask('99/99/9999')
})

function dropzoneCreate(){
  $("#dropzoneImg").dropzone({
    maxFilesize: 2,
    maxFiles:1,
    parallelUploads: 1,
    url: "/upload-imagens",
    acceptedFiles:".jpg, .png",
    dictDefaultMessage: '<i class="fas fa-upload fa-2x mb-2"></i><p>Solte o documento aqui ou clique para fazer o upload.</p>',
    dictFileTooBig: 'Arquivo é maior que o permitido (2MB)',
    dictInvalidFileType: 'Arquivo Inválido!',
    dictMaxFilesExceeded: 'Quantidade máxima de upload de arquivos excedido',
    autoProcessQueue: true,
    addRemoveLinks:true,
    dictRemoveFile: 'Remover',
    success: function (response) {
      $('#loading').modal('hide');
      $('#modal-img-create').modal('hide')
      $('#success_modal').modal('show')
      $(".frase_up").text('Upload efetuado com sucesso!')
    },
    error: function(response){
      $('#loading').modal('hide');
      $('#modal-img-create').modal('hide')
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

function viaCepAjax(){
  $("#form_name_cep").blur(function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
      var validacep = /^[0-9]{8}$/;
      if(validacep.test(cep)) {
        $('#loading').modal('show');
        $.ajax({
          type:'GET',
          url:"https://viacep.com.br/ws/"+ cep +"/json/?callback=?",
          async:true,
          dataType: 'json',       
          success: function(dados){
            $('.alert').addClass('hidden');
            if (!dados.erro) {
               $('#loading').modal('hide');
              $("#form_name_rua").val(dados.logradouro);
              $("#form_name_bairro").val(dados.bairro);
              $("#form_name_cidade").val(dados.localidade);
              $("#form_name_estado").val(dados.uf);
              $('#form_name_numero').focus();
            } 
            else {
              $("#form_name_rua").removeAttr('readonly');
              $("#form_name_bairro").removeAttr('readonly');
              $("#form_name_cidade").removeAttr('readonly');
              $("#form_name_estado").removeAttr('readonly');
               $('#loading').modal('hide');
              $('.alert').removeClass('hidden');
              $('.alert').text("CEP não encontrado.");
            }      
          }
        });
      } 
      else {
        $('.alert').removeClass('hidden');
        $('.alert').text("Formato de CEP inválido");
      }
    }
  });
}

function autoComplete(id, placeholder, rota, multiple = true, minimumInputLength = 0){
  $('#'+id).select2({
    tags: false,
    placeholder:placeholder,
    minimumInputLength: minimumInputLength,
    multiple: multiple,
    closeOnSelect: (multiple ? false : true),
    language: {
      inputTooShort: function() {
        return 'Para buscar insira '+minimumInputLength+' ou mais caracteres';
      },
      noResults: function() {
        return "Não foi encontrado resultados";
      },
    },
    ajax: {
      url: rota,
      dataType: 'json',
      delay: 5,
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });
}

function ajaxSubmitAluno(){
  $("#form-aluno-create").submit(function(e){
    $('#loading').modal('show');
    e.preventDefault()
    $.ajax({
      type:'post',
      url:'/salvarAluno',
      data:$("#form-aluno-create").serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: true,
      success(response){
        $('#loading').modal('hide');
        $('#modal-aluno-create').modal('hide')
        if(response.code){            
          $('#modal-error').modal('show')
          $('.frase_up').text(response.message)
        }else{
          $('#error_modal_aluno').html('')
          $('#success_modal').modal('show')
          $('.frase_up').text(response.message)
        }
      },error(response){
        $('#loading').modal('hide');
        $('#error_modal_aluno').text('Deve-se preencher todos os campos para continuar.')
      }
    });
  })
}

function datatableAlunos(){
  $('#alunos_id').DataTable().destroy();
  $('#alunos_id'+' tbody').empty();
  window.table = $('#alunos_id').DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
    },
    processing: true,
    "bLengthChange" : false,
    "serverSide": false,
    "orderable": false,
    "ajax": {
      url: "/datatableAlunos"
    },
    "search": true,
    columns: [
      { data: 'name', name: 'name'},
      { data: 'cod_aluno', name: 'cod_aluno'},
      { data: 'situacao', name: 'situacao'},
      { data: 'cep', name: 'cep'},
      { data: 'rua', name: 'rua'},
      { data: 'numero', name: 'numero'},
      { data: 'complemento', name: 'complemento'},
      { data: 'bairro', name: 'bairro'},
      { data: 'cidade', name: 'cidade'},
      { data: 'estado', name: 'estado'},
      { data: 'curso', name: 'curso'},
      { data: 'turma', name: 'turma'},
      { data: 'dtmatricula', name: 'dtmatricula'},
      { data: 'button', name: 'button'},
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13]},
      { "bSearchable": false, "aTargets":[0,1,2,3,4,5,6,7,8,9,10,11,12,13]}
    ],
    order: [],
    "pageLength": 999 ,
    drawCallback: function(settings) {
      editaluno()
      excluirAluno()
      $('.img_upload').click(function(){
        $('#id_aluno').val($(this).data('id'))
        $('#modal-img-create').modal('show')
      })
    }
  })
}

function editaluno(){
  $('.aluno_edit').click(function(){
    $('#loading').modal('show');
    $.ajax({
      type:'get',
      url:'/getAluno',
      data: {
        id : $(this).data('id')
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: true,
      success(response){
        $('#loading').modal('hide');
        $('#form_name_aluno').val(response.name)
        $('#form_name_codigo').val(response.cod_aluno)
        $('#form_name_situacao').val(response.situacao_id).trigger('change')
        $('#form_name_curso').val(response.curso_id).trigger('change')
        $('#form_name_turma').val(response.turma)
        $('#form_name_dt').val(response.dtmatricula).trigger('input')
        $('#form_name_cep').val(response.cep)
        $('#form_name_rua').val(response.rua)
        $('#form_name_bairro').val(response.bairro)
        $('#form_name_cidade').val(response.cidade)
        $('#form_name_estado').val(response.estado)
        $('#form_name_numero').val(response.numero)
        $('#form_name_comp').val(response.complemento)
        $('#aluno_id_edit').val(response.id)
        $('#endereco_id_edit').val(response.endereco_id)
        $('#modal-aluno-create').modal('show')
      }
    }); 
  })
}

function excluirAluno(){
  $('.aluno_trash').click(function(){
    $('#loading').modal('show');
    $.ajax({
      type:'delete',
      url:'/deleteAluno',
      data: {
        id : $(this).data('id')
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: false,
      success(response){
        location.reload()
      }
    }); 
  })
}