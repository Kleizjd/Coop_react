<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INFORME ADMINISTRATIVO</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">
  <script src="{{ asset('js/TweenMax.min.js') }}"></script>
  <script src="{{ asset('js/TimelineMax.min.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
  <style type="text/css">
    p {
      margin-top: 0;
      margin-bottom: 0rem !important;
    }
    dl, ol, ul {
      margin-bottom: 0rem !important;
    }
  </style>
  @include('layout.header')
  <div class="content" style="overflow: auto;">
    <p style="color: rgb(0 150 136);
    opacity: 0;
    transition: opacity 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    background: white;
    padding: 1%;
    font-weight: 600;">
      CONTENIDO <span id="span_año_doc"></span>
    </p>
    <div id="documento">
      <div id="contenido-doc">
        <div style="text-align:center;">
          <img style="width: 250px;padding: 5%;" src="{!! asset('img/logo_coopserp.png') !!}">
          <img style="width: 250px;padding: 5%;" src="{!! asset('img/logo_ficidet.png') !!}">
          <img style="width: 250px;padding: 5%;" src="{!! asset('img/logo_seguros.png') !!}">
          <img style="width: 250px;padding: 5%;" src="{!! asset('img/logo_meridiam76_colombia.png') !!}">
          <img style="width: 250px;padding: 5%;" src="{!! asset('img/logo_meridiam76_usa.png') !!}">
        </div>
      </div>
    </div>
  </div>
  @include('layout.script.menu')
</body> 
</html>