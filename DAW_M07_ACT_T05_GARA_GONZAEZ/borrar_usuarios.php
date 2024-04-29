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

			if(isset($_POST["borrar"])){
                $codigos = $_POST["borrar"];
            }

			if(empty($codigos)) {
				echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
			} else if (in_array($_SESSION['id_usuario'], $codigos)) {
				echo "<h3 style='color: red;'> No es posible borrar este usuario ya que tiene una sesión activa. </h3>";
			} else {
				borrar_usuarios($con, $codigos);
				cerrar_conexion($con);
				echo "<h3 style='color: green;'> Los usuarios seleccionados se han borrado con éxito. </h3>";
			}
		?>

		<form action="usuarios.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>