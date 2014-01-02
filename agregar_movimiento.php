<?php     
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }

    include('funciones.php');
    conexion();  

    recupera_combo('tipo',$tipos);
    recupera_combo('concepto',$conceptos);    
    recupera_combo('usuario',$autores);    

?>
<!DOCTYPE html>
<!-- saved from url=(0065)http://twitter.github.io/bootstrap/examples/marketing-narrow.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Agregar Movimiento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }

      .help-block{
        font-size: 12px;
        font-style: italic;
        color: rgb(48, 160, 160);
      }
    </style>
    <link href="http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/smoothness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="http://twitter.github.io/bootstrap/assets/ico/favicon.png">
  <style type="text/css"></style><style type="text/css">@media print { #feedlyMiniIcon { display: none; } }</style></head>

   <script src="./js/jquery.js"></script> 
   <script src="./js/jquery-ui-1.10.3.custom.js"></script> 
   <script src="./js/jquery.ui.datepicker-es.js"></script> 
   

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="listado.php">Listado de Movimientos</a></li>          
          <li><a href="logout.php">Cerrar Session</a></li>          
        </ul>
        <h3 class="muted">Gestión de Gastos</h3>        
      </div>

      <hr>

      <div class="jumbotron">
        <h1>Agregar un Movimiento</h1>                
      </div>    
      <form class="form-horizontal" action="guardar_movimiento.php" method="POST">
        <div class="control-group">
          <label class="control-label" for="fecha">Fecha del Movimiento</label>          
          <div class="controls">
            <input type="text" name="fecha" id="fecha">
            <input type="hidden" name="fechaBD" id="fechaBD">
            <span class="help-block">Fecha en la que se produjo el movimiento. NO en la que se carga.<br>La fecha no puede ser posterior a hoy.</span>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="tipo">Tipo</label>
          <div class="controls">
            <select name="tipo" id="tipo">
              <option value="0">-Selccionar-</option>
              <?php
                while  ($row=mysql_fetch_array($tipos)){
                ?><option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option><?php
                }
              ?>                      
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="importe">Importe</label>
          <div class="controls">
            <input type="text" id="importe" name="importe" placeholder="Ejemplo: 2000">
            <span class="help-block">Ingresar el importe sin comillas, puntos o letras.</span>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="concepto">Concepto</label>
          <div class="controls">
            <select id="concepto" name="concepto">
              <option value="0">-Selccionar-</option>             
            </select>
          </div>
        </div>        
       <div class="control-group">
          <label class="control-label" for="comentarios">Comentarios</label>
          <div class="controls">
            <textarea name="comentarios" id="comentarios" rows="3"></textarea>
            <span class="help-block">Cualquier comentario extra.</span>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">            
            <button type="submit" class="btn">Guardar!</button>
          </div>
        </div>
      </form>

      <hr>
    </div> <!-- /container -->    
  </body>
  <script type="text/javascript">
        $( "#fecha" ).datepicker({ 
            altField: "#fechaBD",
            altFormat: "yy-mm-dd", 
            maxDate: "+0d" 
          });   

        $("#tipo").change(function(){
           if ($("#tipo").val()!=0){
              $.ajax({
                 type: 'POST',         
                 url: 'completaCombo.php',
                 data: {id: $('#tipo').val() },
                 success: function(data) {
                    $('#concepto').empty();
                    $('#concepto').append(data);
                 }
               });
           }
           else{
              //clean
              $('#concepto').empty();
              $('#concepto').append('<option value="0">-Selccionar-</option>');
           }
        });   
  </script>
  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-41778742-1', 'af.cm');
      ga('send', 'pageview');
  </script>
</html>