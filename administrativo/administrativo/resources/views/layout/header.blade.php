<header>
  <!-- CSS only -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="nav">
    <div class="title row">
      <span style="font-size: 20px;">INFORME ADMINISTRATIVO</span>
      <span style="margin-left: 54%; margin-top: 3px; position: absolute; z-index: 15;width: 27%; text-align: end">{!! mb_strtoupper(Session()->get('nombre')) !!}</span>
      @if (session()->has('cedula'))
        <a id="salir" class="dropdown-item" href="{{ url('/logout') }}" style="margin-left: 82%; margin-top: 2px; position: absolute; z-index: 15;width: 5%;">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> SALIR
        </a>
      @else
        <a href="#" id="loginform" style="position: absolute;margin: auto;width: 100px;height: 49px;right: 8%;top: 0;bottom: 0;display: flex;justify-content: center;align-items: center;z-index: 10;cursor: pointer;">
          <svg style="background: white; color: #009688;border-radius: 50%;" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg>
        </a>
      @endIf
    </div>
    <div class="toggle">
      <div class="bar"></div>
    </div>
    <nav class="">
      <div class="menu">
        <div class="row sub-menu" style="margin:0">
          <div class="col-7">
            <h4 style="margin: 1% 0% 0% 0%;">INDICE CAPITULOS</h4>
          </div>
          <div class="col-3">
            <?php 
              $añoActual = date("Y");
            ?>
            <select id="año_doc_dos" class="form-select" aria-label="Default select example">
              @for ($i = 2019; $i <= $añoActual-1; $i++)
                <option value="{!! $i !!}">{!! $i !!}</option>
              @endfor
            </select>
          </div>
        </div>
        @if (session()->has('cedula'))
          <div class="row" style="padding: 1% 2% 0% 6%;">
            <div class="col-1">
              <button onclick="mostrar_form_uno()" class="tooltipp" id="btn-open-uno" style="margin-left: 6%;margin-top: 1%;border-radius: 50%;background: transparent;border: none; cursor: pointer;">
                <svg color="#009688" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
               <span class="tooltiptext">Registrar Indice</span>
              </button>
              <button onclick="cerrar_form_uno()" id="btn-cerrar-dos" style="margin-left: 6%;margin-top: 1%;border-radius: 50%;background: transparent;border: none; cursor: pointer; display: none;">
                <svg color="#009688" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                </svg>
              </button>
              <button onclick="cerrar_form_uno_act()" class="tooltipp" id="btn-open-edit-uno" style="margin-left: 6%;margin-top: 1%;border-radius: 50%;background: transparent;border: none; cursor: pointer; display:none;">
                <svg color="#009688" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>
               <span class="tooltiptext">Cerrar</span>
              </button>
            </div>
            <div id="alert-menu-principal" class="col-10 alert alert-success" role="alert" style="margin-bottom: 0px;padding: 6px;left: 3%;">
              Se ha actualizado el Índice con éxito. 
            </div>
            <div id="cont-reg-ind" class="modal-body col-10" style="display:none">
              <form>
                <div class="row" style="margin: 0">
                  <div class="col-3">
                    <input type="number" name="conse_ind_pri" id="conse_ind_pri" class="form-control" placeholder="Consecutivo">
                  </div>
                  <div class="col-6">
                    <input type="text" name="tit_in_pri" id="tit_in_pri" class="form-control" placeholder="Titulo">
                  </div>
                  <div class="col-2">
                    <a id="btn-add-uno" class="btn btn-success" onclick="form_uno()">Agregar</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        @endIf
        <ul id="menu-principal" class="main-menu"></ul>
      </div>
      <div class="showcase">
        <div class="showcase-container" id="menu-subindices">
          <ul class="showcase-menu">
            @foreach($indice_principales as $indice_principal)
              <div class="row" style="width:100%">
                <div class="col-8">
                  <h4 id="title-indices">
                    {!! $indice_principal->consecutivo !!}. INDICE {!! mb_strtoupper($indice_principal->titulo) !!}
                  </h4>
                </div>
                <div class="col-md-2 col-2">
                  <select class="form-select" aria-label="Default select example" id="tipo_indice_{!! $indice_principal->id !!}" name="tipo_indice" onchange="cambia_provincia({!! $indice_principal->id !!})">
                    <option selected value="1">Informe</option>
                    <option value="2">Tabla</option>
                    <option value="3">Graficas</option>
                  </select>
                </div>
                <div class="col-md-2 col-6">
                  @if (session()->has('cedula'))
                    <a type="button" class="btn btn-success" href="{!! url('/registro_subindice') !!}/1,{!! $indice_principal->id !!},{!! $indice_principal->consecutivo !!},{!! $indice_principal->titulo !!}" target="_blank">Agregar</a>
                  @endIf
                </div>
                <div id="msj-eli-subindice" class="alert alert-danger" role="alert" style="display:none; padding:6px; position: absolute; width:97%">SubItem eliminado con exito.
                </div>
              </div>
              <br>
              <li id="li-subindice-{!! $indice_principal->id !!}">
                <div id="carga-animation" style="text-align: center;width: 80%;">
                  <div class="contenedor-loader">
                    <div class="loader"></div>
                  </div>
                  <div class="cargando">Cargando...</div>  
                </div>
                <div id="cont-menu-subInidice"></div>
              </li>
            @endForeach
          </ul>
        </div>
      </div>
    </nav> 
  </div>
</header>

<!-- Moda Login -->
<div class="modal-login fade" id="modal_login" aria-hidden="true">
  <div class="modal-dialog" role="document" style="right: 5%;top: 15px;display: flex;justify-content: end;z-index: 10;">
    <div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">
        <div class="randompad">
          <form id="fom_login">
            <div id="mjs-error" class="alert alert-danger" role="alert"></div>
            @csrf
            <fieldset>
              <label>Cedula</label>
              <input id="cedula" name="cedula" type="cedula" />
              <label>Password</label>
              <input id="password" name="password"type="password" />
              <button id="enviar" onclick="login()"/>Login</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> 

<!-- Modal principal -->
<div id="modal-inicio" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button class="close" hidden></button>
      <div class="modal-body">
        <p style="padding: 2%;background: aliceblue;">Selecciona el <strong>año</strong> del documento que deseas ver.</p>
        <?php 
          $añoActual = date("Y");
        ?>
        <select id="año_doc" class="form-select" aria-label="Default select example">
          <option selected disabled>Selecciona</option>
          @for ($i = 2019; $i <= $añoActual-1; $i++)
            <option value="{!! $i !!}">{!! $i !!}</option>
          @endfor
        </select>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar SubItem -->
<div class="modal fade" id="modal-eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Estas seguro que deseas eliminar este SubItem</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="conf_eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast Registro Form Uno-->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position:absolute;">
  <div class="alert alert-success" id="alert-success" role="alert" style="position: fixed;z-index: 5;top: 12%;left: 39%; background: #009688;color: white;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
    </svg> Se ha registrado el Índice con éxito.
  </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/jquery.cookie.min.js') }}"></script>
<script type="text/javascript">

  $(window).load(function() {
    //Saber si existe la cockie annoDoc
    var coockieAño = $.cookie("annoDoc");
    if (coockieAño == "0" || coockieAño == undefined) {
      //Crear Cockie
      $('#modal-inicio').modal('show');
      document.cookie = "annoDoc=0";
    }
    //Inicializa el select de año de coumento en la fecha elegida en la cockie
    $('#año_doc_dos option[value^=\"'+coockieAño+'\"]').attr('selected', true);
    //Elimina cockies
    //return document.cookie = 'annoDoc=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';

    $.get("{{asset('indice_principal/')}}/"+coockieAño, function(data) {
      if (data.length != 0) {
        indiceArray = [];
        var indicesArray = data.map(function(index){
          indiceArray.push(index.id);
          return `<li id="li-menu-principal-${index.id}">
            <a href="#" onmouseover="subIndice(${index.id})">
              ${index.titulo.toUpperCase()}
            </a>
            <?php if (session()->has('cedula')) {?>
              <span id="icon-edit" onclick="menu_pri_edit(${index.id})" title="Editar">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" color="white">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
              </span>
              <span id="icon-eliminar-${index.id}" class="icon-eliminar" title="Eliminar" onclick="menu_pri_eliminar(${index.id})">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="white">
                  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
              </span>
            <?php }?>
          </li>`
        });
        if (indiceArray != 0) {
          document.getElementById('menu-principal').innerHTML = indicesArray.join('');
          var min = Math.min(...indiceArray) 
          var active = document.querySelector("#li-menu-principal-"+min);
          active.setAttribute("class", "active");
          navNumbers(data);
          subIndice(min);
        }
        document.getElementById('menu-subindices').style.display= 'block';
      }else{
        document.getElementById('menu-principal').innerHTML = '<div id="alert-indice" style="display: block;width: 90%;text-align: center;font-size: 20px;margin: 12% 4%;" class="alert alert-warning" role="alert">No se encontrarón resultados.</div>';
        document.getElementById('menu-subindices').style.display= 'none';
      }
    });
  });

  function cerrar_form_uno_act(){
    btnOpenUno = document.getElementById('btn-open-uno');
    btnOpenUno.style.display = "block";
    btnOpenEditUno = document.getElementById('btn-open-edit-uno'); 
    btnOpenEditUno.style.display = "none";
    contRegInd = document.getElementById('cont-reg-ind'); 
    contRegInd.style.display = "none";
    $('#conse_ind_pri').val('');
    $('#tit_in_pri').val('');
    btnAddUno = document.getElementById('btn-add-uno'); 
    btnAddUno.removeAttribute("onclick", "form_uno_actualizar()");
    btnAddUno.innerHTML = "Registrar";
  }

  var select = document.getElementById('año_doc');
  select.addEventListener('change', 
    function(){
      var selectedOption = this.options[select.selectedIndex];
      $('#modal-inicio').modal('hide');
      
      coockieAño = document.cookie.match("(^|;) ? annoDoc=([^;]*)(;|$)");
      document.getElementById('span_año_doc').innerHTML = coockieAño;
      if (coockieAño == null) {
        expires = new Date();
        expires.setTime(expires.getTime() + 31536000); // Estableces el tiempo de expiración
        añoDoc = "annoDoc=" + selectedOption.value + ";expires=" + expires.toUTCString();
        document.cookie = añoDoc;
        $('#año_doc_dos option[value^=\"'+selectedOption.value+'\"]').attr('selected', true);

        document.getElementById('span_año_doc').innerHTML = selectedOption.value;
        
        $.get("{{asset('indice_principal/')}}/"+selectedOption.value, function(data) {
          if (data.length != 0) {
            indiceArray = [];
            var indicesArray = data.map(function(index){
              indiceArray.push(index.id);
              return `<li id="li-menu-principal-${index.id}">
                <a href="#" onmouseover="subIndice(${index.id})">
                  ${index.titulo.toUpperCase()}
                </a>
                <?php if (session()->has('cedula')) {?>
                  <span id="icon-edit" onclick="menu_pri_edit(${index.id})" title="Editar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" color="white">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </span>
                  <span id="icon-eliminar-${index.id}" class="icon-eliminar" title="Eliminar" onclick="menu_pri_eliminar(${index.id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="white">
                      <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                  </span>
                <?php }?>
              </li>`
            });
            if (indiceArray != 0) {
              document.getElementById('menu-principal').innerHTML = indicesArray.join('');
              var min = Math.min(...indiceArray) 
              var active = document.querySelector("#li-menu-principal-"+min);
              active.setAttribute("class", "active");
              navNumbers(data);
              subIndice(min);
            }
            document.getElementById('menu-subindices').style.display= 'block';
          }else{
            document.getElementById('menu-principal').innerHTML = '<div id="alert-indice" style="display: block;width: 90%;text-align: center;font-size: 20px;margin: 12% 4%;" class="alert alert-warning" role="alert">No se encontrarón resultados.</div>';
            document.getElementById('menu-subindices').style.display= 'none';
          }
        });
      }
    }
  );

  var indicePrincipal = document.getElementById('año_doc_dos');
  indicePrincipal.addEventListener('change', 
    function(){
      var selectedOption = this.options[indicePrincipal.selectedIndex];
      
      document.getElementById('span_año_doc').innerHTML = selectedOption.value;
      $.get("{{asset('indice_principal/')}}/"+selectedOption.value, function(data) {
        if (data.length != 0) {
          indiceArray = [];
          var indicesArray = data.map(function(index){
            indiceArray.push(index.id);
            return `<li id="li-menu-principal-${index.id}">
              <a href="#" onmouseover="subIndice(${index.id})">
                ${index.titulo.toUpperCase()}
              </a>
              <?php if (session()->has('cedula')) {?>
                <span id="icon-edit" onclick="menu_pri_edit(${index.id})" title="Editar">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" color="white">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </span>
                <span id="icon-eliminar-${index.id}" class="icon-eliminar" title="Eliminar" onclick="menu_pri_eliminar(${index.id})">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="white">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                  </svg>
                </span>
              <?php }?>
            </li>`
          });
          if (indiceArray != 0) {
            document.getElementById('menu-principal').innerHTML = indicesArray.join('');
            var min = Math.min(...indiceArray) 
            var active = document.querySelector("#li-menu-principal-"+min);
            active.setAttribute("class", "active");
            navNumbers(data);
            subIndice(min);
          }
          document.getElementById('menu-subindices').style.display= 'block';
        }else{
          document.getElementById('menu-principal').innerHTML = '<div style="display: block;width: 90%;text-align: center;font-size: 20px;margin: 12% 4%;" class="alert alert-warning" role="alert">No se encontrarón resultados.</div>';
          document.getElementById('menu-subindices').style.display= 'none';
        }
      });
    }
  );

  function cambia_provincia(id){
    //var selectTipo = document.getElementById('tipo_indice_'+id);
    //var tipo = selectTipo.value;
    subIndice(id)
  }

  function subItemEliminar(num, id, div, id_pri){

    $("#modal-eliminar").modal('show');
    $("#conf_eliminar").click(function(){
      let _token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url : "{{asset('/subindice/eliminar/')}}/"+[num, id],
        type : 'POST',
        data:{
          _token: _token
        }, 
        dataType : 'json',
        success : function(datos) {

          if(num == 2){
            var divs = $("#body-ind-dos-"+id_pri+" #accordion_segundo");
            for(var i = 0; i <= divs.length; i++){
              if (i == div) {
                divs[i].remove();
              }
            }
            subIndice(id_pri);
          }

          if(num == 3){
            var divs = $("#body-ind-dos-"+id_pri+" #accordion_tercero");
            for(var i = 0; i <= divs.length; i++){
              if (i == div) {
                divs[i].remove();
              }
            }
            subItemTres(id_pri);
          }

          if(num == 4){
            var divs = $("#body-ind-tres-"+id_pri+" #accordion_cuarto");
            for(var i = 0; i <= divs.length; i++){
              if (i == div) {
                divs[i].remove();
              }
            }
            subItemCuatro(id_pri);
          }
          
          if(num == 5){
            var divs = $("#body-ind-cuatro-"+id_pri+" #accordion_quinto");
            for(var i = 0; i <= divs.length; i++){
              if (i == div) {
                divs[i].remove();
              }
            }
            subItemCinco(id_pri);
          }

          $("#modal-eliminar").modal('hide');

          document.getElementById('msj-eli-subindice').style.display = "block";
          setTimeout(function() {
            $("#msj-eli-subindice").fadeOut(1500);
          },3000);
        },
        error : function(xhr, status) {
          console.log(xhr)
        }
      });
    })
  }

  function subIndice(id){
    var selectTipo = document.getElementById('tipo_indice_'+id);
    var tipo = selectTipo.value;

    $.ajax({
      url : "{{asset('index_subindice/')}}/"+[id, tipo],
      type : 'GET',
      dataType : 'json',
      success : function(datos) {
        if (datos.length != 0) {
          arraySubIndice = datos.map(function(index, i){
            return `<div class="accordion accordion-flush" id="accordion_secundario" style="width: 99%;">
              <div class="accordion-item" style="margin-bottom: 5px;">
                <h2 class="accordion-header row" id="flush-headingOne">
                  <a href="#" style="color:white; font-size:18px; max-width: 79%;" onclick="ver_doc(${2},${index.id})"><strong style="color:#7dd1c9">${index.consecutivo}</strong> - ${index.titulo}
                  </a>
                  <button onclick="subItemTres(${index.id})" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subIndice-${index.id}" aria-expanded="false" aria-controls="flush-collapseOne" style="width:5%;">
                  </button>  
                  <?php if (session()->has('cedula')) {?>
                    <div style="margin-top: -9px; width: 16%;">
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-success" href="{!! url('/registro_subindice/') !!}/${2},${index.id},${index.consecutivo},${index.titulo}" target="_blank" title="Agregar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" color="white" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                      </a>
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-info" href="{!! url('/subindice/editar/') !!}/${2},${index.id}" target="_blank" title="Editar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                      </a>
                      <a id="subi-icon-eliminar-${index.id}" style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-danger" onclick="subItemEliminar(${2},${index.id},${i++},${id})" target="_blank" title="Eliminar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                      </a>
                    </div>
                  <?php }?>
                </h2>
                <div id="subIndice-${index.id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_secundario" style="    margin-top: 1%;margin-right: 1%;">
                  <div id="body-ind-dos-${index.id}" class="accordion-body" style="color:white; padding: 0% 0% 1% 4%;">
                    <div style="display: block;font-size: 12px;padding: 1%;margin: 1px 1px 10px 0px;width: 89%;" class="alert alert-warning" role="alert">No se encontraron sub items</div>
                  </div>
                </div>
              </div>
            </div>`
          });
          document.getElementById('li-subindice-'+id).innerHTML = arraySubIndice.join('');
        }else{
          document.getElementById('li-subindice-'+id).innerHTML = '<div style="display: block;width: 80%;text-align: center;font-size: 14px;margin: 6% 1%;" class="alert alert-warning" role="alert">No se encontrarón resultados.</div>';
        }
      },
      error : function(xhr, status) {
        //alert('Disculpe, existió un problema');
      }
    });
  }

  $('div[id="enviar"]').mousedown(function(){
    $(this).css('background', '#2ecc71');
  });

  $('div[id="enviar"]').mouseup(function(){
    $(this).css('background', '#1abc9c');
  });

  $('#loginform').click(function(){
    $('.login').fadeToggle('slow');
    $(this).toggleClass('green');
    $('.modal-login').fadeToggle('modal');
    $(this).toggleClass('green');
  });

  function login(){
    let _token = $('meta[name="csrf-token"]').attr('content');
    cedula  = $('#cedula').val();
    password = $('#password').val();
    $.ajax({
      url:  "{!! url('/login') !!}",
      type: "POST",
      data:{
        cedula: cedula,
        contrasena: password,
        _token: _token
      },
      cache: false,
      beforeSend: function(){
        btnEnviar = document.getElementById('enviar');
        btnEnviar.innerHTML = "Autenticando...";
        $("#enviar").prop('disabled', true); 
      },
      success: function(data){
        mjsError = document.getElementById("mjs-error");
        switch (data) {
          case '0':
            mjsError.style.display = "block";
            mjsError.innerHTML = "Este ususario no esta registrado.";
            btnEnviar.innerHTML = "Login";
            btnEnviar.disabled = false;
            break;
          case '2':
            mjsError.style.display = "block";
            mjsError.innerHTML = "Contraseña incorrecta.";
            btnEnviar.innerHTML = "Login";
            btnEnviar.disabled = false;
            break;
          default:
            mjsError.style.display = "none";
            btnEnviar.innerHTML = "Login";
            $("#enviar").prop('disabled', false); 
            location.reload();
        }
      },
      error: function(data){
        console.log(data)
        alert('Error')
      }
    })
  }

  function mostrar_form_uno(){
    document.getElementById('btn-open-uno').style.display = "none";
    document.getElementById('btn-cerrar-dos').style.display = "block";
    document.getElementById('cont-reg-ind').style.display = "block";
  }

  function cerrar_form_uno(){
    document.getElementById('btn-open-uno').style.display = "block";
    document.getElementById('btn-cerrar-dos').style.display = "none";
    document.getElementById('cont-reg-ind').style.display = "none";
  }

  function form_uno(){
    let _token      = $('meta[name="csrf-token"]').attr('content');
    var select      = document.getElementById("año_doc_dos");
    let año         = select.value;
    let consecutivo = $('#conse_ind_pri').val();
    let titulo      = $('#tit_in_pri').val();
    let usuario     = "<?php echo session()->get('cedula');?>";
  
    $.ajax({
      url:  "{!! url('/form_uno') !!}",
      type: "POST",
      data:{
        año:         año,
        consecutivo: consecutivo,
        titulo:      titulo,
        usuario:     usuario,
        _token:      _token
      }, 
      cache: false,
      beforeSend: function(){
        btnEnviar = document.getElementById('btn-add-uno');
        btnEnviar.innerHTML ='<div class="spinner-border" role="status" style="width: 20px;height: 20px;"><span class="sr-only"></span></div>';
        $("#btn-add-uno").prop('disabled', true); 
      },
      success: function(data){
        btnEnviar.innerHTML ='Agregar';
        $("#btn-add-uno").prop('disabled', false); 
        $('.toast').toast('show');
        document.getElementById('alert-success').style.display = "block"
        $('#conse_ind_pri').val('');
        $('#tit_in_pri').val('');
        var ul       = document.getElementById("menu-principal");
        var li       = document.createElement("li");
        var div      = document.createElement("div");
        var a        = document.createElement("a");
        var span     = document.createElement("span");
        var spanDos  = document.createElement('span');

        li.setAttribute("data-target", data.consecutivo);
        div.setAttribute("class", "number");
        a.setAttribute("href", "#");
        spanDos.setAttribute("class", "badge text-bg-primary");
        a.appendChild(document.createTextNode(data.titulo));
        spanDos.appendChild(document.createTextNode("Nuevo"));
        span.appendChild(document.createTextNode(data.consecutivo));
        ul.appendChild(li);
        li.appendChild(div);
        li.appendChild(a);
        li.appendChild(spanDos);
        div.appendChild(span);
      },
      error: function(response){
        console.log(response)
      }
    })
  }

  function menu_pri_edit(id){
    document.getElementById('alert-menu-principal').style.display = "none";
    document.getElementById('cont-reg-ind').style.display = "block";
    var array = <?php echo json_encode($indice_principales);  ?>;
    function esId(menu) {
      return menu.id === id;
    }
    menu = array.find(esId);
    $('#conse_ind_pri').val(menu.consecutivo);
    $('#tit_in_pri').val(menu.titulo);
    btnAddUno = document.getElementById('btn-add-uno'); 
    btnAddUno.setAttribute("onclick", 'form_uno_actualizar('+id+')');
    btnAddUno.innerHTML = "Editar";
    btnOpenUno = document.getElementById('btn-open-uno');
    btnOpenUno.style.display = "none";
    btnCerrarDos = document.getElementById('btn-cerrar-dos');
    btnCerrarDos.style.display = "none";
    btnOpenEditUno = document.getElementById('btn-open-edit-uno'); 
    btnOpenEditUno.style.display = "block";
  }

  function form_uno_actualizar(id){
  
    let _token      = $('meta[name="csrf-token"]').attr('content');
    let consecutivo = $('#conse_ind_pri').val();
    let titulo      = $('#tit_in_pri').val();
    let usuario     = "<?php echo session()->get('cedula');?>";
  
    $.ajax({
      url:  "{!! url('/form_uno/update') !!}/"+id,
      type: "POST",
      data:{
        consecutivo: consecutivo,
        titulo:      titulo,
        usuario:     usuario,
        _token:      _token
      }, 
      cache: false,
      beforeSend: function(){
        btnEnviar = document.getElementById('btn-add-uno');
        btnEnviar.innerHTML ='<div class="spinner-border" role="status" style="width: 20px;height: 20px;"><span class="sr-only"></span></div>';
        $("#btn-add-uno").prop('disabled', true); 
      },
      success: function(data){
        cerrar_form_uno_act();
        document.getElementById('alert-menu-principal').style.display = 'block';
        const divs = document.querySelectorAll('#alert-menu-principal');
        let interval = setInterval(() => {
          divs[0].style.display = 'none';
          clearInterval(interval);
        }, 3000);

        var liSpan = document.getElementById("li-menu-principal-"+id)
        .getElementsByTagName('div')[0].getElementsByTagName('span')[0];
        liSpan.innerHTML = data.consecutivo;

        var liA = document.getElementById("li-menu-principal-"+id)
          .getElementsByTagName('a')[0];
        liA.innerHTML = data.titulo;
      },
      error: function(response){
        console.log(response)
      }
    });
  }

  function menu_pri_eliminar(id){
    let _token      = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      url:  "{!! url('/form_uno/eliminar') !!}/"+id,
      type: "POST",
      data:{
        _token: _token
      }, 
      cache: false,
      beforeSend: function(){
        btnEliminar = document.getElementById('icon-eliminar-'+id);
        btnEliminar.innerHTML = '<div class="spinner-border" role="status" style="width: 20px;height: 20px;"><span class="sr-only"></span></div>';
      },
      success: function(data){
        document.getElementById('alert-menu-principal').style.display = 'block';
        document.getElementById('alert-menu-principal').innerHTML = 'Se ha Eliminado el Índice con éxito.';
        const divs = document.querySelectorAll('#alert-menu-principal');
        let interval = setInterval(() => {
          divs[0].style.display = 'none';
          clearInterval(interval);
        }, 3000);

        var liMenuPrincipal = document.getElementById("li-menu-principal-"+id);
        liMenuPrincipal.remove();
      },
      error: function(response){
        console.log(response)
      }
    });
  }

  function subItemTres(id){
    $.ajax({
      url : "{{asset('index_subindice_tres/')}}/"+id,
      type : 'GET',
      dataType : 'json',
      success : function(datos) {
        if (datos.length != 0) {
          arraySubIndice = datos.map(function(index, i){
            return `<div class="accordion accordion-flush" id="accordion_tercero" style="width: 99%;">
              <div class="accordion-item" style="margin-bottom: 5px;">
                <h2 class="accordion-header row" id="flush-headingOne">
                  <a href="#" style="color:white; font-size:18px; max-width: 76%;" onclick="ver_doc(${3},${index.id})"><strong style="color:#7dd1c9">${index.consecutivo}</strong> - ${index.titulo}
                  </a>
                  <button onclick="subItemCuatro(${index.id})" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subIndiceTres-${index.id}" aria-expanded="false" aria-controls="flush-collapseOne" style="width:5%;">
                  </button>
                  <?php if (session()->has('cedula')) {?>
                    <div style="margin-top: -9px; width: 17%">
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-success" href="{!! url('/registro_subindice/') !!}/${3},${index.id},${index.consecutivo},${index.titulo}" target="_blank" title="Agregar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" color="white" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                      </a>
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-info" href="{!! url('/subindice/editar/') !!}/${3},${index.id}" target="_blank" title="Editar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                      </a>
                      <a id="subi-icon-eliminar-${index.id}" style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-danger" onclick="subItemEliminar(${3},${index.id},${i++},${id})" target="_blank" title="Eliminar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                      </a>
                    </div>
                  <?php }?>
                </h2>
                <div id="subIndiceTres-${index.id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_tercero" style="margin-top: 1%;padding-right: 1%;">
                  <div id="body-ind-tres-${index.id}" class="accordion-body" style="color:white; padding: 0% 0% 1% 5%;"><div style="display: block;font-size: 12px;padding: 1%;margin: 1px 1px 10px 0px;width: 89%;" class="alert alert-warning" role="alert">No se encontraron sub items</div></div>
                </div>
              </div>
            </div>`
          });
          document.getElementById('body-ind-dos-'+id).innerHTML = arraySubIndice.join('');
        }
      },
      error : function(xhr, status) {
        console.log(xhr)
          //alert('Disculpe, existió un problema');
      }
    });
  }

  function subItemCuatro(id){
    $.ajax({
      url : "{{asset('index_subindice_cuatro/')}}/"+id,
      type : 'GET',
      dataType : 'json',
      success : function(datos) {
        if (datos.length != 0) {
          arraySubIndice = datos.map(function(index, i){
            return `<div class="accordion accordion-flush" id="accordion_cuarto" style="width: 99%;">
              <div class="accordion-item" style="margin-bottom: 5px;">
                <h2 class="accordion-header row" id="flush-headingOne">
                  <a href="#" style="color:white; font-size:18px; width: 72%" onclick="ver_doc(${4},${index.id})"><strong style="color:#7dd1c9">${index.consecutivo}</strong> - ${index.titulo}
                  </a>
                  <button onclick="subItemCinco(${index.id})" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subIndiceCuatro-${index.id}" aria-expanded="false" aria-controls="flush-collapseOne" style="width:5%;">
                  </button>
                  <?php if (session()->has('cedula')) {?>
                    <div style="margin-top: -9px; padding-right:0px; width: 17%">
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-success" href="{!! url('/registro_subindice/') !!}/${4},${index.id},${index.consecutivo},${index.titulo}" target="_blank" title="Agregar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" color="white" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                      </a>
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-info" href="{!! url('/subindice/editar/') !!}/${4},${index.id}" target="_blank" title="Editar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                      </a>
                      <a id="subi-icon-eliminar-${index.id}" style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-danger" onclick="subItemEliminar(${4},${index.id},${i++},${id})" target="_blank" title="Eliminar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                      </a>
                    </div>
                  <?php }?>
                </h2>
                <div id="subIndiceCuatro-${index.id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_cuarto" style="margin-top: 1%;padding-right: 1%;">
                  <div id="body-ind-cuatro-${index.id}" class="accordion-body" style="color:white; padding: 0% 0% 1% 5%;"><div style="display: block;font-size: 12px;padding: 1%;margin: 1px 1px 10px 0px;width: 89%;" class="alert alert-warning" role="alert">No se encontraron sub items</div></div>
                </div>
              </div>
            </div>`
          });
          document.getElementById('body-ind-tres-'+id).innerHTML = arraySubIndice.join('');
        }
      },
      error : function(xhr, status) {
        console.log(xhr);
      }
    });
  }

  function subItemCinco(id){
    $.ajax({
      url : "{{asset('index_subindice_cinco/')}}/"+id,
      type : 'GET',
      dataType : 'json',
      success : function(datos) {
        if (datos.length != 0) { 
          arraySubIndice = datos.map(function(index, i){
            return `<div class="accordion accordion-flush" id="accordion_quinto" style="width: 99%;">
              <div class="accordion-item" style="margin-bottom: 5px;">
                <h2 class="accordion-header row" id="flush-headingOne">
                  <a href="#" style="color:white; font-size:18px; max-width: 71%;" onclick="ver_doc(${5}, ${index.id})"><strong style="color:#7dd1c9">${index.consecutivo}</strong> - ${index.titulo}
                  </a>
                  <?php if (session()->has('cedula')) {?>
                    <div style="margin-top: -9px; padding-right:0px; text-align:end; width:17%">
                      <a style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-info" href="{!! url('/subindice/editar/') !!}/${5},${index.id}" target="_blank" title="Editar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                      </a>
                      <a id="subi-icon-eliminar-${index.id}" style="font-size: 14px;padding: 3px; margin:auto" type="button" class="btn btn-danger" onclick="subItemEliminar(${5},${index.id},${i++},${id})" target="_blank" title="Eliminar subItem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                      </a>
                    </div>
                  <?php }?>
                </h2>
                <div id="subIndiceCinco-${index.id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_quinto">
                  <div id="body-ind-cinco-${index.id}" class="accordion-body" style="color:white; padding: 0% 0% 1% 3%;"><div style="display: block;font-size: 12px;padding: 1%;margin: 1px 1px 10px 0px;width: 89%;" class="alert alert-warning" role="alert">No se encontraron sub items</div></div>
                </div>
              </div>
            </div>`
          });
          document.getElementById('body-ind-cuatro-'+id).innerHTML = arraySubIndice.join('');
        }
      },
      error : function(xhr, status) {
        console.log(xhr)
          //alert('Disculpe, existió un problema');
      }
    });
  }

  function ver_doc(num, id){
    tl = new TimelineMax();

    tl.call(function() {
      toggleMenu();
    }, null, null, 0.2);
    $.ajax({
      url : "{{asset('doc_subind_dos/')}}/"+[num, id],
      type : 'GET',
      dataType : 'json',
      success : function(datos) {
        if (datos[0].contenido != null) {
          document.getElementById('contenido-doc').innerHTML = datos[0].contenido;
        }else{
          document.getElementById('contenido-doc').innerHTML = '<div style="margin:auto;text-align: center;"><h4><strong>Este Inidice no tiene contenido</strong></h4></div>'
        }
      },
      error : function(xhr, status) {
          //alert('Disculpe, existió un problema');
      }
    });
  }
</script>