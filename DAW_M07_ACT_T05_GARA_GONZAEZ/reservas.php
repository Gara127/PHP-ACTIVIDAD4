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

			echo "<h2> RESERVAS </h2>";

			$reservas = obtener_reservas($con);
			$num_filas = obtener_num_filas($reservas);

			if($num_filas == 0){
				echo "<h3 style='color: red;'> No se han encontrado reservas </h3>";
			}
			else{
				echo "<form method='post' action='borrar_reservas.php'>
					<table border='1'>
					<tr><td>ID</td><td>USUARIO</td><td>PISTA</td><td>TURNO</td><td>BORRAR</td></tr>";
					while($info = obtener_info($reservas)){
						extract($info);
						
						echo "<tr>
							<td> $id_reserva </td>";

							// USUARIO
							$usuario = obtener_usuario_id($con, $id_usuario);
							$info = obtener_info($usuario);
							extract($info);
							echo "<td> $nombre </td>";

							// PISTA
							$pista = obtener_pista_id($con, $id_pista);
							$info = obtener_info($pista);
							extract($info);
							echo "<td> $nombre </td>

							<td> $turno </td>
							<td>
								<input type='checkbox' name='borrar[]' value='$id_reserva'>
							</td>
						</tr>";
					}
				echo "<tr><td colspan='5' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>";
				echo "</table></form>";
			}

			echo "</br><hr>";

			echo "<form method='post' action='borrar_todas_reservas.php'>
					<input type='submit' value='Borrar todo'></form>";
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