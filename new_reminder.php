<?php
    session_start();
    if (!isset ($_SESSION["user"])){
      header('Location: enter.php');
    }

    include('functions.php');
    $reminders = getCombo('motivo_recordatorio');
    $authors = getCombo('usuario');
    include('header.html');
?>
  <body>
    <div class="container-narrow">
     <?php
      include('menu.html');
     ?>
      <hr>
      <div class="jumbotron">
        <h1>Agregar un Recordatorio</h1>
      </div>
      <form class="form-horizontal" action="save_reminder.php" method="POST">
        <div class="control-group">
          <label class="control-label" for="fecha">Fecha del Recordatorio</label>
          <div class="controls">
            <input type="text" id="fecha" name="fecha" placeholder="">
            <input type="hidden" name="fechaBD" id="fechaBD">
            <span class="help-block">La fecha en la que vence el servicio que se esta cargando.<br>La fecha no puede anterior a hoy.</span>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="importe">Importe</label>
          <div class="controls">
            <input type="text" id="importe" name="importe" placeholder="Ejemplo: 2000">
            <span class="help-block">Ingresar el importe sin comillas, puntos o letras, o dejarlo vacío en caso de no conocerlo aún.</span>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="concepto">Concepto</label>
          <div class="controls">
            <select id="concepto" name="concepto">
              <option value="0">-Selccionar-</option>
              <?php
                foreach($reminders as $reminder){
                ?><option value="<?php echo $reminder['id']; ?>"><?php echo $reminder['nombre']; ?></option><?php
                }
              ?>
            </select>
          </div>
        </div>        
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Guardar!</button>
          </div>
        </div>
      </form>
      <hr>
    </div>
  </body>
  <script type="text/javascript">
        $("#fecha").datepicker({
            altField: "#fechaBD",
            altFormat: "yy-mm-dd",
            minDate: "+0d"
          });

        $("#type").change(function(){
           if ($("#type").val()!=0){
              $.ajax({
                 type: 'POST',
                 url: 'fillCombo.php',
                 data: {id: $('#type').val() },
                 success: function(data) {
                    $('#concept').empty();
                    $('#concept').append(data);
                 }
               });
           }
           else{
              //clean
              $('#concept').empty();
              $('#concept').append('<option value="0">-Selccionar-</option>');
           }
        });
  </script>
<?php
  include('footer.html');
?>
