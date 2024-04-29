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

			echo "<h2> USUARIOS </h2>";

			$usuarios = obtener_usuarios($con);
			$num_filas = obtener_num_filas($usuarios);

			if($num_filas == 0){
				echo "<h3 style='color: red;'> No se han encontrado usuarios </h3>";
			}
			else{
				echo "<form method='post' action='borrar_usuarios.php'> 
					<table border='1'>
					<tr><td>ID</td><td>NOMBRE</td><td>TIPO</td><td>MODIFICAR</td><td>BORRAR</td></tr>";
					while($info = obtener_info($usuarios)){
						extract($info);
						
						$rol = "";
						if ($tipo == 1) {
							$rol = "USUARIO";
						} else {
							$rol = "ADMINISTRADOR";
						}
						
						echo "<tr>
							<td> $id_usuario </td>
							<td> $nombre </td>
							<td> $rol </td>
							<td>
								<a href='editar_usuario.php?id_usuario=$id_usuario'> Modificar </a>
							</td>
							<td>
								<input type='checkbox' name='borrar[]' value='$id_usuario'>
							</td>
						</tr>";
					}
				echo "<tr><td colspan='5' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>";
				echo "</table></form>";
			}

			echo "</br><hr>";
			echo "<h2> NUEVO USUARIO </h2>";

			echo "<form method='post' action='nuevo_usuario.php'>
					Tipo: <select name='tipo'>
						<option value='1'> USUARIO </option>
						<option value='0'> ADMINISTRADOR </option>
					</select><br>
					Nombre: <input type='text' name='nombre'><br>
					Password: <input type='text' name='password'><br>
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