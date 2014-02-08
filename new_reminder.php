<?php 
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
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
          <label class="control-label" for="autor">Autor</label>
          <div class="controls">
            <select id="autor" name="autor">
              <option value="0">-Selccionar-</option>
              <?php
                foreach ($authors as $autor){
                ?><option value="<?php echo $autor['id']; ?>"><?php echo $autor['nombre']; ?></option><?php
                }
              ?>           
            </select>
            <span class="help-block">Autor de la CARGA del recordatorio.</span>
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
<?php
  include('footer.html');
?>