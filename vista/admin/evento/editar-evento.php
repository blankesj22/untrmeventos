<?php
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) :
  die("Error");
else :
  include_once '../../plantillas/cabecera-admin.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Eventos
        <small>Puede modificar los datos del Evento aquí.</small>
      </h1>
    </section>
    <div class="row">
      <div class="col-md-8">
        <section class="content">
          <!-- Main content -->
          <div class="box">
            <!-- Default box -->
            <div class="box-header with-border">
              <h3 class="box-title">Editar Evento</h3>
            </div>
            <div class="box-body">
              <?php
              $sql = "SELECT * FROM evento WHERE id_evento = $id ";
              $resultado = $conn->query($sql);
              $evento = $resultado->fetch_assoc();
              ?>
              <!-- form start -->
              <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="../../../modelo/modelo-evento.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="tituloevento">Título Evento: </label>
                    <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Ingrese el título del evento" value="<?php echo $evento['nombre_evento']; ?>">
                  </div>

                  <div class="form-group">
                    <label for="categoria">Categoría Evento: </label>
                    <select name="categoria_evento" class="form-control seleccionar">
                      <option value="0"> -- Seleccione -- </option>
                      <?php
                      try {
                        $categoria_actual = $evento['id_cat_evento'];
                        $sql = "SELECT * FROM categoria_evento ";
                        $resultado = $conn->query($sql);
                        while ($cat_evento = $resultado->fetch_assoc()) {
                          if ($cat_evento['id_categoria'] == $categoria_actual) { ?>
                            <option value="<?php echo $cat_evento['id_categoria']; ?>" selected>
                              <?php echo $cat_evento['cat_evento']; ?>
                            </option>
                          <?php } else { ?>
                            <option value="<?php echo $cat_evento['id_categoria']; ?>">
                              <?php echo $cat_evento['cat_evento']; ?>
                            </option>
                      <?php }
                        }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                  <!-- Date -->
                  <div class="form-group">
                    <label for="datepicker">Fecha Evento:</label>
                    <?php
                    $fecha = $evento['fecha_evento'];
                    $fecha_formato = date('m/d/Y', strtotime($fecha));
                    ?>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento" value="<?php echo $fecha_formato; ?>">
                    </div> <!-- /.input group -->
                  </div> <!-- /.form group -->

                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Hora Evento:</label>
                      <?php
                      $hora = $evento['hora_evento'];
                      $hora_formato = date('h:i a', strtotime($hora));
                      ?>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="hora_evento" value="<?php echo $hora_formato; ?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div> <!-- /.input group -->
                    </div> <!-- /.form group -->
                  </div>

                  <div class="form-group">
                    <label for="nombre">Invitado o Ponente Evento: </label>
                    <select name="invitado" class="form-control seleccionar">
                      <option value="0"> -- Seleccione -- </option>
                      <?php
                      try {
                        $invitado_actual = $evento['id_inv'];
                        $sql = "SELECT id_invitado, nombre_invitado, apellidopa_invitado, apellidoma_invitado FROM invitado ";
                        $resultado = $conn->query($sql);
                        while ($invitado = $resultado->fetch_assoc()) {
                          if ($invitado['id_invitado'] == $invitado_actual) { ?>
                            <option value="<?php echo $invitado['id_invitado']; ?>" selected>
                              <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?>
                            </option>
                          <?php } else { ?>
                            <option value="<?php echo $invitado['id_invitado']; ?>">
                              <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?>
                            </option>
                      <?php }
                        }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div> <!-- /.box-body -->
                <div class="box-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-primary">Guardar</button>
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
endif;
?>