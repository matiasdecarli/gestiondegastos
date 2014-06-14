<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: enter.php');  
    }
    include('header.html');
?>
  <body>
    <div class="container-narrow">
     <?php include('menu.html'); ?>
      <hr>
      <div class="jumbotron">
        <h1>Listado de Ultimos Movimientos</h1>        
      </div>    
      <?php 
        include("functions.php");
        $movements = getLastMovements(20);        
      ?>      
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Concepto</th>              
                <!-- <th>Saldo</th> -->
                <th>Autor</th>
                <th>Detalle</th>
              <tr>
            </thead>
            <tbody>
              <?php                 
                foreach ($movements as $movement){ 
                    if ($movement['tipo']=='Ingreso')
                        echo '<tr class="success">';
                    else                           
                      echo '<tr class="error">';            
                      $date = new DateTime($movement['fecha']);
                      echo '<td>'.$date->format('d/m/Y');'</td>';
                      echo '<td>'.number_format($movement['importe'],2,',','.') .'</td>';
                      echo '<td>'.$movement['concepto'].'</td>';
                      echo '<td>'.$movement['autor'].'</td>';
                      echo '<td><a href="detail.php?id='.$movement['id'].'" class=" icon-question-sign"></a></td>';
                    echo '<tr>';
                } ?>
            </tbody>          
          </table>
        <hr>
    </div> 
  </body>
<?php 
  include('footer.html');
 ?>