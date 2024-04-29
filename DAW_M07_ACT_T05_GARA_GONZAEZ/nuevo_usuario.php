<html>
	<head>
		<title> USUARIOS </title>
	</head>
	<body>
		<?php
			require("validacion.php");
			check("admin");
			
			require("database.php");
			$con = conectar();

			if(isset($_POST["tipo"])){
                $tipo = $_POST["tipo"];
            }

            if(isset($_POST["nombre"])){
                $nombre = $_POST["nombre"];
            }

			if(isset($_POST["password"])){
                $password = $_POST["password"];
            }

			if(!isset($tipo) || empty($nombre) || empty($password)) {
				echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
			} else {
				crear_usuario($con, $tipo, $nombre, $password);
				cerrar_conexion($con);
				echo "<h3 style='color: green;'> Usuario creado con éxito. </h3>";
			}
		?>

		<form action="usuarios.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>