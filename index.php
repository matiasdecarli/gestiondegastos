<?php  
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }
?>
<!DOCTYPE html>
<!-- saved from url=(0065)http://twitter.github.io/bootstrap/examples/marketing-narrow.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Gestión de Gastos</title>
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
        font-size: 72px;
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
          <li class="active"><a href="index.php">Inicio</a></li>
          <li><a href="listado.php">Listado de Movimientos</a></li>          
          <li><a href="logout.php">Cerrar Session</a></li>          
        </ul>
        <h3 class="muted">Gestión de Gastos</h3>
      </div>

      <hr>

      <?php if (isset($_GET['resultado'])){ 
              if ($_GET['resultado']=='ok'){ ?>        
                  <div class="alert alert-success">
                    La operación se ha completado exitosamente!
              <?php } 
              else{ ?>                    
                  <div class="alert alert-error">
                    Se ha producido un error. Por favor intentelo nuevamente!
          <?php }  ?>          
          </div>
      <?php } ?>

      <?php if (isset($_PRE['resultado'])){ ?>
          <div class="alert alert-error">
            <?php echo $_PRE['error'] ?>
          </div>
      <?php } ?>

      <div class="jumbotron">
        <?php include ('funciones.php');?>
        <h2>Saldo: $<?php echo number_format(recupera_saldo(),2,',','.'); ?></h2>
        <p class="lead">
          <?php
            if (date('d')>8){
                //calcula cuanto falta para el mes que viene
                $datetime1 = new DateTime();
                $datetime2 = new DateTime(date('Y-m-8'));
                $datetime2->add(new DateInterval('P1M'));
                $interval = $datetime1->diff($datetime2);

            }         
            else{
                //calcula para este
                $datetime1 = new DateTime();
                $datetime2 = new DateTime(date('Y-m-8'));
                $interval = $datetime1->diff($datetime2);
            }
        ?> 
            Dias* para cobrar Alice: <?php echo $interval->format('%a'); ?></br>
        <?php
            if (date('d')>25){
                //calcula cuanto falta para el mes que viene
                $datetime1 = new DateTime();
                $datetime2 = new DateTime(date('Y-m-25'));
                $datetime2->add(new DateInterval('P1M'));
                $interval = $datetime1->diff($datetime2);

            }         
            else{
                //calcula para este
                $datetime1 = new DateTime();
                $datetime2 = new DateTime(date('Y-m-25'));
                $interval = $datetime1->diff($datetime2);
            }
        ?> 
            Dias* para cobrar Corrientes: <?php echo $interval->format('%a'); ?>
             <h6>* Para este calculo, se toma en cuenta 2 días antes de la fecha de vencimiento.</h6>
        </p>
        <a class="btn btn-large btn-success" href="agregar_movimiento.php">Agregar Movimiento</a>
      </div>          
      <hr>

      <div class="jumbotron">
        <h2>Próximos Vencimientos</h2>  
        <?php    
          ultimos_recordatorios($recordatorios);        
        ?>      
      </div>    
      <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Importe</th>
              <th>Concepto</th>                            
              <th>Borrar</th>                            
            <tr>
          </thead>
          <tbody>
            <?php                 
                while ($row=mysql_fetch_array($recordatorios)){                                                                                                
                      $date = new DateTime($row['fecha']);
                      if ($row['fecha']<=date('Y-m-d'))
                        echo '<tr class="error">';                           
                      else
                        echo '<tr>';                                             
                      echo '<td>'.$date->format('d/m/Y');'</td>';
                      echo '<td>'.number_format($row['importe'],2,',','.') .'</td>';
                      echo '<td>'.$row['concepto'].'</td>';                                  
                      echo '<td><a href="eliminar_recordatorio.php?id='.$row['id'].'"class="icon-remove"></a></td>';
                    echo '</tr>';
                } ?>
          </tbody>          
        </table>
        
        <div class="jumbotron">
          <a class="btn btn-large btn-primary" href="agregar_recordatorio.php">Agregar Recordatorio</a>
        </div>

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