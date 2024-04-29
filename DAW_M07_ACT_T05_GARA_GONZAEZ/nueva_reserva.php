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

			if(isset($_POST["id_usuario"])){
                $id_usuario = $_POST["id_usuario"];
            }

            if(isset($_POST["id_pista"])){
                $id_pista = $_POST["id_pista"];
            }

			if(isset($_POST["turno"])){
                $turno = $_POST["turno"];
            }

			if(empty($id_usuario) || empty($id_pista) || empty($turno)) {
				echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
			} else if($turno < 0) {
				echo "<h3 style='color: red;'> Introduzca un turno correcto. </h3>";
			} else {
				$reserva = obtener_reserva($con, $id_pista, $turno);
				$num_filas = obtener_num_filas($reserva);

				if ($num_filas == 0) {
					crear_reserva($con, $id_usuario, $id_pista, $turno);
					cerrar_conexion($con);
					echo "<h3 style='color: green;'> Reserva creada con éxito. </h3>";
				} else {
					echo "<h3 style='color: red;'> Lo sentimos, la reserva seleccionada ya está ocupada. </h3>";
				}
			}
		?>

		<form action="perfil_usuario.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>