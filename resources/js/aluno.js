$(document).ready(function(){
  datatableAlunos()
  ajaxSubmitAluno()
  autoComplete('form-name-curso', 'Cursos', '/autoCompleteCursos', false);
  autoComplete('form-name-situacao', 'Situação', '/autoCompleteSituacao', false);
})

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
    e.preventDefault()
    $.ajax({
      type:'post',
      url:'/salvarAluno',
      data:$("#form-aluno-create").serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: false,
      success(response){
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
            for(index in obj.form_name_curso){
              html += '<span>'+obj.form_name_curso[index]+'</span> <br>'
            }
            $('#error_modal_curso').html(html)
            
          }
          
        }
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
    }
  })
}

function editaluno(){
  $('.aluno_edit').click(function(){
    $.ajax({
      type:'get',
      url:'/getaluno',
      data: {
        id : $(this).data('id')
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      async: false,
      success(response){
        $('#form_name_aluno').val(response.name)
        $('#form_codigo_aluno').val(response.cod_aluno)
        $('#aluno_id_edit').val(response.id)
        $('#modal-aluno-create').modal('show')
      }
    }); 
  })
}

function excluirAluno(){
  $('.aluno_trash').click(function(){
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