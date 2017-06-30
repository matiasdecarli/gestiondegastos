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
        <?php include ('functions.php');?>
        <h2>Saldo: $<?php echo number_format(getSaldo(),2,',','.'); ?></h2>
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
            Dias* para cobrar Corrientes: <?php echo $interval->format('%a'); ?></br>
            Dias* para cobrar Dumbledor: <?php echo $interval->format('%a'); ?>
             <h6>* Para este calculo, se toma en cuenta 2 días antes de la fecha de vencimiento.</h6>
        </p>
        <a class="btn btn-large btn-success" href="new_movement.php">Agregar Movimiento</a>
      </div>
      <hr>
      <div class="jumbotron">
        <h2>Próximos Vencimientos</h2>
        <?php
          $reminders = getReminders(100);
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
                foreach ($reminders as $reminder){
                      $date = new DateTime($reminder['fecha']);
                      if ($reminder['fecha']<=date('Y-m-d'))
                        echo '<tr class="error">';
                      else
                        echo '<tr>';
                      echo '<td>'.$date->format('d/m/Y');'</td>';
                      echo '<td>'.number_format($reminder['importe'],2,',','.') .'</td>';
                      echo '<td>'.$reminder['concepto'].'</td>';
                      echo '<td><a href="delete_reminder.php?id='.$reminder['id'].'"class="icon-remove"></a></td>';
                    echo '</tr>';
                } ?>
          </tbody>
        </table>
        <div class="jumbotron">
          <a class="btn btn-large btn-primary" href="new_reminder.php">Agregar Recordatorio</a>
        </div>
        <hr>
    </div>
  </body>
<?php
  include('footer.html')
?>
