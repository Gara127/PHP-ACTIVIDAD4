<html>
	<head>
		<title> PERFIL USUARIO </title>
	</head>
	<body>
		<?php
			require("validacion.php");
			check("usuario");
			
			require("database.php");
			$con = conectar();

			$nombre = $_SESSION['nombre'];
			$id_usuario =$_SESSION['id_usuario'];

			echo "<h3 style='color: green;'> Bienvenido $nombre! </h3>";

			echo "<h2> RESERVAS </h2>";

			$reservas = obtener_reservas_usuario($con, $id_usuario);
			$num_filas = obtener_num_filas($reservas);

			if($num_filas == 0){
				echo "<h3 style='color: red;'> No tienes ninguna reserva actualmente </h3>";
			}
			else{
				echo "<form method='post' action='borrar_reservas.php'> 
					<table border='1'>
					<tr><td>ID</td><td>PISTA</td><td>TURNO</td><td>BORRAR</td></tr>";
					while($info = obtener_info($reservas)){
						extract($info);
						
						echo "<tr>
							<td> $id_reserva </td>";

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
			echo "<h2> NUEVA RESERVA </h2>";

			$pistas = obtener_pistas($con);

			echo "<form method='post' action='nueva_reserva.php'>
					<input type='hidden' name='id_usuario' value='$id_usuario'>
					Pista: <select name='id_pista'>";
					while($info = obtener_info($pistas)){
						extract($info);
						echo "<option value='$id_pista'>$nombre</option>";
					}
					echo "</select><br>
					Turno: <input type='number' name='turno'><br>
					<input type='submit' value='Crear'></form>";
			echo "<hr></br>";

			cerrar_conexion($con);
		?>

		<form action="logout.php" method="post">
			<input type="submit" value="Logout">
		</form>
	</body>
</html>
