<?php
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Eventos
      <small>Llena el formulario para crear un Evento.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Evento</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="../../../modelo/modelo-evento.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="tituloevento">Título Evento: </label>
                  <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Ingresar título del evento">
                </div>
                <div class="form-group">
                  <label for="categoria">Categoría Evento: </label>
                  <select name="categoria_evento" class="form-control seleccionar">
                    <option value="0"> -- Seleccione -- </option>
                    <?php
                    try {
                      $sql = "SELECT * FROM categoria_evento ";
                      $resultado = $conn->query($sql);
                      while ($cat_evento = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $cat_evento['id_categoria']; ?>">
                          <?php echo $cat_evento['cat_evento']; ?>
                        </option>
                    <?php }
                    } catch (Exception $e) {
                      echo "Error: " . $e->getMessage();
                    }

                    /**while($categoria = $resultado->fetch_assoc()){
                      ?>
                         <option value="<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['cat_evento']; ?> </option>
                      <?php
                        }**/
                    ?>
                  </select>
                </div>

                <!-- Date -->
                <div class="form-group">
                  <label for="datepicker">Fecha Evento:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento">
                  </div> <!-- /.input group -->
                </div> <!-- /.form group -->

                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Hora Evento:</label>
                    <div class="input-group">
                      <input type="text" class="form-control timepicker" name="hora_evento">
                      <div class="input-group-addon">
                        <i class="fa fa-clock"></i>
                      </div>
                    </div> <!-- /.input group -->
                  </div> <!-- /.form group -->
                </div>

                <div class="form-group">
                  <label for="nombre">Invitado o Ponente del Evento: </label>
                  <select name="invitado" class="form-control seleccionar">
                    <option value="0"> -- Seleccione -- </option>
                    <?php
                    try {
                      $sql = "SELECT id_invitado, nombre_invitado, apellidopa_invitado, apellidoma_invitado FROM invitado ";
                      $resultado = $conn->query($sql);
                      while ($invitado = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $invitado['id_invitado']; ?>">
                          <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?>
                        </option>
                    <?php }
                    } catch (Exception $e) {
                      echo "Error: " . $e->getMessage();
                    }
                    ?>
                  </select>
                </div>
              </div> <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->
<?php
include_once '../../plantillas/footer-admin.php';
?>