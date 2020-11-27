/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

/**
* The following block of code may be used to automatically register your
* Vue components. It will recursively scan this directory for the Vue
* components and automatically register them with their "basename".
*
* Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

const app = new Vue({
  el: '#app',
});

$(document).ready(function(){
  $('#form-name-curso').select2({
    placeholder: 'todos',
    multiple: true
  });
  
  $("#dropzoneForm").dropzone({
    maxFilesize: 2,
    maxFiles:1,
    parallelUploads: 1,
    url: "/interno/upload-arquivos?type=doc",
    acceptedFiles:".pdf, .xls, .odt, .doc, .docx, .svg , .png, .jpg, .jpeg",
    dictDefaultMessage: '<i class="fas fa-upload fa-2x mb-2"></i><p>Solte o documento aqui ou clique para fazer o upload.</p>',
    dictFileTooBig: 'Arquivo é maior que o permitido (2MB)',
    dictInvalidFileType: 'Arquivo Inválido!',
    dictMaxFilesExceeded: 'Quantidade máxima de upload de arquivos excedido',
    autoProcessQueue: true,
    addRemoveLinks:true,
    dictRemoveFile: 'Remover',
    success: function (response) {
      $('#success_modal').modal('show')
      $(".frase_up").text('Upload do documento feito com sucesso!')
    },
    error: function(response){
      if(response.status == "error"){
        if(response.size > 2000000)
        $('#modal-error-msg').text('Erro ao enviar arquivo! O arquivo deve ter no máximo 2mb!');  
      }
      else if(response.xhr && response.xhr.status == 401)
      $('#modal-error-msg').text('Erro ao enviar arquivo! Arquivo duplicado!');
      else
      $('#modal-error-msg').text('Erro ao enviar arquivo! Formato incorreto!');
      
      $('#modal-error').modal('show');
    }
  });
  
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