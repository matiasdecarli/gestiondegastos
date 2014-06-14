<?php     
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: enter.php');  
    }
    include('functions.php');    
    $types = getCombo('tipo');
    $authors = getCombo('usuario'); 
    include('header.html');
?>
  <body>
    <div class="container-narrow">
      <?php include('menu.html'); ?>
      <hr>
      <div class="jumbotron">
        <h1>Agregar un Movimiento</h1>                
      </div>    
      <form class="form-horizontal" action="save_movement.php" method="POST">
        <div class="control-group">
          <label class="control-label" for="fecha">Fecha del Movimiento</label>          
          <div class="controls">
            <input type="text" name="fecha" id="fecha">
            <input type="hidden" name="fechaBD" id="fechaBD">
            <span class="help-block">Fecha en la que se produjo el movimiento. NO en la que se carga.<br>La fecha no puede ser posterior a hoy.</span>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="type">Tipo</label>
          <div class="controls">
            <select name="type" id="type">
              <option value="0">-Selccionar-</option>
              <?php
                foreach ($types as $type){
                ?><option value="<?php echo $type['id']; ?>"><?php echo $type['nombre']; ?></option><?php
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
          <label class="control-label" for="concept">Concepto</label>
          <div class="controls">
            <select id="concept" name="concept">
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
    </div> 
  </body>  
  <script type="text/javascript">
        $("#fecha").datepicker({ 
            altField: "#fechaBD",
            altFormat: "yy-mm-dd", 
            maxDate: "+0d" 
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