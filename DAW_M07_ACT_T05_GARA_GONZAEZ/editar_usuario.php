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

			if(isset($_POST['modificar'])){
				if(isset($_POST["tipo"])){
					$tipo = $_POST["tipo"];
				}
	
				if(isset($_POST["nombre"])){
					$nombre = $_POST["nombre"];
				}
	
				if(isset($_POST["password"])){
					$password = $_POST["password"];
				}

				if(isset($_POST["id_usuario"])){
					$id_usuario = $_POST["id_usuario"];
				}
	
				if(!isset($tipo) || empty($nombre) || empty($password) || empty($id_usuario)) {
					echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
				} else {
					modificar_usuario($con, $id_usuario, $tipo, $nombre, $password);
					echo "<h3 style='color: green;'> Usuario modificado con éxito. </h3>";
				}
			} else {
				if(isset($_GET["id_usuario"])){
					$id_usuario = $_GET["id_usuario"];
				}

				if(empty($id_usuario)) {
					echo "<h3 style='color: red;'> Se ha producido un error, por favor intentelo de nuevo. </h3>";
				} else if ($id_usuario == $_SESSION['id_usuario']) {
					echo "<h3 style='color: red;'> No es posible editar este usuario ya que tiene una sesión activa. </h3>";
				} else {
					$usuario = obtener_usuario_id($con, $id_usuario);
					$num_filas = obtener_num_filas($usuario);
					if($num_filas == 0){
						echo "<h3 style='color: red;'> No se ha encontrado el usuario especificado </h3>";
					}
					else{
						$info = obtener_info($usuario);
						extract($info);

						echo "<h2> MODIFICAR USUARIO </h2>";

						echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>
								<input type='hidden' name='id_usuario' value='$id_usuario'>
								Tipo: <select name='tipo'>";
									if ($tipo == 0) {
										echo "<option value='1'> USUARIO </option>
											<option value='0' selected> ADMINISTRADOR </option>";
									} else {
										echo "<option value='1' selected> USUARIO </option>
											<option value='0'> ADMINISTRADOR </option>";
									}
								echo "</select><br>
								Nombre: <input type='text' name='nombre' value='$nombre'><br>
								Password: <input type='text' name='password' value='$pass'><br>
								<input type='submit' name='modificar' value='Modificar'></form>";
						echo "<hr></br>";
					}
				}
			}

			cerrar_conexion($con);
		?>

		<form action="usuarios.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>