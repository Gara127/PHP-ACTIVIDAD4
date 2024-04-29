<html>
	<head>
		<title> RESERVAS </title>
	</head>
	<body>
		<?php
			require("validacion.php");
			check("admin");
			
			require("database.php");
			$con = conectar();

			if (isset($_POST['confirmar'])) {
				borrar_todas_reservas($con);
				echo "<h3 style='color: green;'> Todas las reservas se han borrado con éxito. </h3>";
			} else {
				echo "<h3> Está seguro de que desea borrar todas las reservas? </h3>";

				echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>
					<input type='submit' name='confirmar' value='SI'></form>";

				echo "<form method='post' action='reservas.php'>
					<input type='submit' value='NO'></form>";
				echo "<hr></br>";
			}
			
			cerrar_conexion($con);
		?>

		<form action="reservas.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>