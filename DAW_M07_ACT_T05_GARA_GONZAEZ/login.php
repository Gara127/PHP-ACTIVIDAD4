<html>
	<head>
		<title> LOGIN </title>
	</head>
	<body>
        <?php
            session_start();
            require("database.php");

            $con = conectar();

            if(isset($_POST["nombre"])){
                $nombre = $_POST["nombre"];
            }

            if(isset($_POST["password"])){
                $password = $_POST["password"];
            }

            if(empty($nombre) || empty($password)){
                echo "<h3 style='color: red;'> Por favor introduzca las credenciales </h3>";
            }else{
                $usuario = obtener_usuario($con, $nombre, $password);
                $num_filas = obtener_num_filas($usuario);

                if($num_filas == 0){
                    echo "<h3 style='color: red;'> Error de inicio de sesión: Las credenciales proporcionadas son incorrectas. ".
                        "Asegúrate de que el nombre de usuario y la contraseña son correctos. </h3>";
                }
                else{
                    while($info = obtener_info($usuario)){
                        extract($info);
                    }

                    $_SESSION['tipo'] = $tipo;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['id_usuario'] = $id_usuario;

                    if ($tipo == 0) {
                        header('Location: perfil_admin.php');
                        exit();
                    } else {
                        header('Location: perfil_usuario.php');
                        exit();
                    }
                }
            }
        ?>
        
        <form action="login.html" method="post">
            <input type="submit" value="Volver al inicio">
        </form>
	</body>
</html>
