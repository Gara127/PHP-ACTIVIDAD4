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

			echo "<h2> PISTAS </h2>";

			$pistas = obtener_pistas($con);
			$num_filas = obtener_num_filas($pistas);

			if($num_filas == 0){
				echo "<h3 style='color: red;'> No se han encontrado pistas </h3>";
			}
			else{
				echo "<form method='post' action='borrar_pistas.php'> 
					<table border='1'>
					<tr><td>ID</td><td>NOMBRE</td><td>MODIFICAR</td><td>BORRAR</td></tr>";
					while($info = obtener_info($pistas)){
						extract($info);
						
						echo "<tr>
							<td> $id_pista </td>
							<td> $nombre </td>
							<td>
								<a href='editar_pista.php?id_pista=$id_pista'> Modificar </a>
							</td>
							<td>
								<input type='checkbox' name='borrar[]' value='$id_pista'>
							</td>
						</tr>";
					}
				echo "<tr><td colspan='5' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>";
				echo "</table></form>";
			}

			echo "</br><hr>";
			echo "<h2> NUEVA PISTA </h2>";

			echo "<form method='post' action='nueva_pista.php'>
					Nombre: <input type='text' name='nombre'><br>
					<input type='submit' value='Crear'></form>";
			echo "<hr></br>";

			cerrar_conexion($con);
		?>

		<form action="perfil_admin.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>

		<form action="logout.php" method="post">
			<input type="submit" value="Logout">
		</form>
	</body>
</html>