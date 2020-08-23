<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) :
    die("Error");
else :
?>

    <?php
    $id = openssl_decrypt($_POST['id'], COD, KEY);
    if (!filter_var($id, FILTER_VALIDATE_INT)) :
        die("Error");
    else :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Editar Beneficios
                    <small>Aquí podrás modificar el beneficio seleccionado.</small>
                </h1>
            </section>
            <div class="row">
                <div class="col-md-12">
                    <section class="content">
                        <!-- Main content -->
                        <div class="box">
                            <!-- Default box -->

                            <div class="box-header with-border">
                                <h3 class="box-title">Editar Beneficio</h3>
                            </div>
                            <form method="post" action="dashboard">
                                <div class="box-body">

                                    <?php
                                    $sql = "SELECT * FROM beneficio WHERE idbeneficio = $id ";
                                    $resultado = $conn->query($sql);
                                    $beneficio = $resultado->fetch_assoc();
                                    ?>
                                    <div class="form-group">

                                        <!-- Nombre -->
                                        <div class="form-group col-md-6">
                                            <label for="nombre">Nombre: </label>
                                            <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?php echo $beneficio['nombre']; ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                                    <button type="submit" name="dashboard" value="beneficio-editar1" class="btn btn-primary">Actualizar</button>
                                </div>

                            </form>
                        </div> <!-- /.box-body -->

                    </section> <!-- /.content -->
                </div> <!-- /.box -->
            </div>
        </div> <!-- /.content-wrapper -->
    <?php
    endif;
    ?>
<?php
endif;
?>