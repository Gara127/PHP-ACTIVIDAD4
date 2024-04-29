<html>
	<head>
		<title> PISTAS </title>
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
			} else {
				borrar_pistas($con, $codigos);
				cerrar_conexion($con);
				echo "<h3 style='color: green;'> Las pistas seleccionadas se han borrado con éxito. </h3>";
			}
		?>

		<form action="pistas.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>