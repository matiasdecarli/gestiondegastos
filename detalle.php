<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }
    include ('funciones.php');
    busca_movimiento($_GET['id'],$movimiento);
?>
<!DOCTYPE html>
<!-- saved from url=(0065)http://twitter.github.io/bootstrap/examples/marketing-narrow.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Listado de Movimientos</title>
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

      .form-horizontal .control-label {
        width: 460px;
      }
    </style>
    <link href="http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

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

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="listado.php">Listado de Movimientos</a></li>          
        </ul>
        <h3 class="muted">Gestión de Gastos</h3>        
      </div>

      <hr>

      <div class="jumbotron">
        <h1>Detalle de Movimiento</h1>        
      </div>          
      <?php while ($row=mysql_fetch_array($movimiento)){ ?>
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label"><b>Fecha del movimiento:</b> <?php $date = new DateTime($row['fecha']);echo $date->format('d/m/Y');?> </label>                    
        </div>
        <div class="control-group">
          <label class="control-label"><b>Tipo:</b> <?php echo $row['tipo'] ?></label>          
        </div>
        <div class="control-group">
          <label class="control-label"><b>Importe:</b> <?php echo number_format($row['importe'],2,',','.') ?></label>          
        </div>
        <div class="control-group">
          <label class="control-label"><b>Concepto:</b> <?php echo $row['concepto'] ?></label>          
        </div>        
         <div class="control-group">
          <label class="control-label"><b>Autor:</b> <?php echo $row['autor'] ?></label>          
        </div>
       <div class="control-group">
          <label class="control-label"><b>Comentarios:</b> <?php echo $row['comentarios'] ?></label>          
        </div>        
      </form>
      <?php } ?>
        <hr>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script> 
  </body>
   <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-41778742-1', 'af.cm');
      ga('send', 'pageview');
  </script>
</html>