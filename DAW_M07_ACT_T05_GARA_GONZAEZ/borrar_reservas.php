<html>
	<head>
		<title> RESERVAS </title>
	</head>
	<body>
		<?php
			require("database.php");
			$con = conectar();

			if(isset($_POST["borrar"])){
                $codigos = $_POST["borrar"];
            }

			if(empty($codigos)) {
				echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
			} else {
				borrar_reservas($con, $codigos);
				cerrar_conexion($con);
				echo "<h3 style='color: green;'> Las reservas seleccionadas se han borrado con éxito. </h3>";
			}
		?>

		<!-- En caso de que el usuario no sea un admin, se redirije al perfil de usuario -->
		<form action="reservas.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>