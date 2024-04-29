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

            if(isset($_POST["nombre"])){
                $nombre = $_POST["nombre"];
            }

			if(empty($nombre)) {
				echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
			} else {
				crear_pista($con, $nombre);
				cerrar_conexion($con);
				echo "<h3 style='color: green;'> Pista creada con éxito. </h3>";
			}
		?>

		<form action="pistas.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>