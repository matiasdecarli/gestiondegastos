<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: enter.php');  
    }
    include ('functions.php');
    $movement = getMovement($_GET['id']);    
    include('header.html');
?>
   <style type="text/css">
      .form-horizontal .control-label {
        width: 460px;
      }
    </style>
  <body>
    <div class="container-narrow">
     <?php include('menu.html'); ?>
      <hr>
      <div class="jumbotron">
        <h1>Detalle de Movimiento</h1>        
      </div>          
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label"><b>Fecha del movimiento:</b> <?php $date = new DateTime($movement['fecha']);echo $date->format('d/m/Y');?> </label>                    
        </div>
        <div class="control-group">
          <label class="control-label"><b>Tipo:</b> <?php echo $movement['tipo'] ?></label>          
        </div>
        <div class="control-group">
          <label class="control-label"><b>Importe:</b> <?php echo number_format($movement['importe'],2,',','.') ?></label>          
        </div>
        <div class="control-group">
          <label class="control-label"><b>Concepto:</b> <?php echo $movement['concepto'] ?></label>          
        </div>        
         <div class="control-group">
          <label class="control-label"><b>Autor:</b> <?php echo $movement['autor'] ?></label>          
        </div>
       <div class="control-group">
          <label class="control-label"><b>Comentarios:</b> <?php echo $movement['comentarios'] ?></label>          
        </div>        
      </form>
        <hr>
    </div> 
    <script src="./js/jquery.js"></script> 
  </body>
<?php
  include('footer.html')
?>