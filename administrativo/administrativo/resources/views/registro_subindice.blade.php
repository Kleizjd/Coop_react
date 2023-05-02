<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('/ckeditor/samples/js/sample.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
  <script src="{{ asset('js/ckeditor.js') }}"></script>
</head>
<body>
  <style type="text/css">
    .cke_wysiwyg_frame {
      width: 90% !important;
      margin: 5%;
      box-shadow: 2px 2px 5px 3px grey;
    }
    #cke_editor1 {
      margin: auto;
    }
    #form_subindice{
      width: 100%;
      margin: auto;
    }
    #cke_contenido{
      margin: auto;
    }
  </style>
  <div style="padding: 3% 10% 0% 10%; background:url('https://static3.depositphotos.com/1000791/123/i/950/depositphotos_1238211-stock-photo-abstract-green-background.jpg')">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Vas agregar un indice en el item</li>
        <li class="breadcrumb-item active" aria-current="page" style="color: blue; font-weight: 700">{!! $titulo_cons !!}</li>
      </ol>
    </nav>
    <form id="form_subindice" style="background: #c5ccd3;padding: 2%; box-shadow: 2px 7px 9px 5px #584d4d;">
      <div class="row" style="margin: 0">
        <div style="display:none" id="alert-mjs-success" class="alert alert-success" role="alert"></div>
        <div class="col-3">
          <div class="input-group mb-3">
            <input type="text" style="width: 100px;background: #009688; color: white;" class="input-group-text" id="cons_ind_prim" value="{!! $consecutivo !!}." disabled>
            <input type="number" name="consecutivo" id="consecutivo" class="form-control" placeholder="Consecutivo" aria-label="consecutivo" aria-describedby="consecutivo">
          </div>
        </div>
        @if($tipo == 1)
          <div class="col-2">
            <select class="form-select" aria-label="Default select example" id="tipo_indice">
              <option selected value="1">Informe</option>
              <option value="2">Tabla</option>
              <option value="3">Graficas</option>
            </select>
          </div>
        @endIf
        <div class="col-6">
          <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo">
        </div>
        <div class="col-1">
          <a id="btn-add-dos" class="btn btn-success" onclick="form_dos()">Agregar</a>
        </div>
      </div>
      <br>
      <textarea cols="80" id="contenido" name="contenido" rows="10"></textarea>
    </form>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    //Inicializa editor de texto
    CKEDITOR.replace('contenido', {
      // Make the editing area bigger than default.
      height: 800,
      width: 960,
      extraPlugins: 'editorplaceholder',
      editorplaceholder: 'Hola {!! mb_strtoupper(Session()->get('nombre')) !!}!. Redacta o pega la información en este cuadro de texto.',
      removeButtons: 'PasteFromWord',

      // Allow pasting any content.
      allowedContent: true,

      // Fit toolbar buttons inside 3 rows.
      toolbarGroups: [{
          name: 'document',
          groups: ['mode', 'document', 'doctools']
        },
        {
          name: 'clipboard',
          groups: ['clipboard', 'undo']
        },
        {
          name: 'editing',
          groups: ['find', 'selection', 'spellchecker', 'editing']
        },
        {
          name: 'forms',
          groups: ['forms']
        },
        '/',
        {
          name: 'paragraph',
          groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
        },
        {
          name: 'links',
          groups: ['links']
        },
        {
          name: 'insert',
          groups: ['insert']
        },
        '/',
        {
          name: 'styles',
          groups: ['styles']
        },
        {
          name: 'basicstyles',
          groups: ['basicstyles', 'cleanup']
        },
        {
          name: 'colors',
          groups: ['colors']
        },
        {
          name: 'tools',
          groups: ['tools']
        },
        {
          name: 'others',
          groups: ['others']
        },
        {
          name: 'about',
          groups: ['about']
        }
      ],

      // Remove buttons irrelevant for pasting from external sources.
      removeButtons: 'ExportPdf,Form,Checkbox,Radio,TextField,Select,Textarea,Button,ImageButton,HiddenField,NewPage,CreateDiv,Flash,Iframe,About,ShowBlocks,Maximize',

      // An array of stylesheets to style the WYSIWYG area.
      // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
      contentsCss: [
        'http://cdn.ckeditor.com/4.20.0/full-all/contents.css'
      ],

      // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
      bodyClass: 'document-editor'
    });

    function form_dos(){
      var selectTipo = document.getElementById('tipo_indice');

      let _token        = $('meta[name="csrf-token"]').attr('content');
      let id_ind_prim   = "<?php echo $id_indice; ?>";
      let cons_ind_prim = $('#cons_ind_prim').val();
      let consecutivo   = $('#consecutivo').val();
      tipovalue = "<?php echo $tipo; ?>";
      if (tipovalue != 1) {
        tipo = 0;
      }else{
        tipo = selectTipo.value;
      }
      let titulo        = $('#titulo').val();
      let contenido     = CKEDITOR.instances['contenido'].getData();
      let usuario       = "<?php echo session()->get('cedula');?>";
      
      $.ajax({
        url:  "{!! url('/form_dos') !!}/<?php echo $tipo;?>",
        type: "POST",
        data:{
          id_ind:      id_ind_prim,
          cons_ind:    cons_ind_prim,
          consecutivo: consecutivo,
          tipo:        tipo,
          titulo:      titulo,
          contenido:   contenido,
          usuario:     usuario,
          _token:      _token
        }, 
        cache: false,
        beforeSend: function(){
          btnEnviar = document.getElementById('btn-add-dos');
          btnEnviar.innerHTML ='<div class="spinner-border" role="status" style="width: 20px;height: 20px;"><span class="sr-only"></span></div>';
          $("#btn-add-dos").prop('disabled', true); 
        },
        success: function(data){
          console.log(data);
          btnEnviar.innerHTML ='Agregar';
          $("#btn-add-dos").prop('disabled', false); 
          $('#consecutivo').val('');
          $('#titulo').val('');
          
          CKEDITOR.instances['contenido'].setData('');
       
          alertMjsSuccess = document.getElementById('alert-mjs-success'); 
          alertMjsSuccess.innerHTML = "El subindice se ha registrado de manera Exitosa, por favor recarga la pagina principal para ver los cambios.";
          alertMjsSuccess.style.display = "block";
          
        },
        error: function(response){
          console.log(response)
        }
      })
    }
  </script>
</body> 
</html>


