<?php
    //Código para login de los administradores
    if(isset($_POST['login-admin'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        
        try {
            include_once 'funciones-admin.php';
            $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?; ");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $editado, $nivel);
            if($stmt->affected_rows) {
                $existe = $stmt->fetch(); //imprime los resultados y almacena en la variable.
                if($existe) { //Validamos si existe contenido de la variable.
                    //Compara el password con el hash
                    if(password_verify($password, $password_admin)) {
                        //Si es correcto, iniciamos sesión.
                        session_start();
                        $_SESSION['usuario'] = $usuario_admin;
                        $_SESSION['nombre'] = $nombre_admin;
                        $_SESSION['nivel'] = $nivel;
                        $_SESSION['id'] = $id_admin;
                        //Luego enviamos el array respuesta.
                        $respuesta = array(
                            'respuesta' => 'exitoso',
                            'usuario' => $nombre_admin 
                        );
                    } else {
                        $respuesta = array(
                            'respuesta' => 'error'
                        );
                    }
                } else {
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }
            $stmt->close();
            $conn->close();
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        die(json_encode($respuesta));
    }
