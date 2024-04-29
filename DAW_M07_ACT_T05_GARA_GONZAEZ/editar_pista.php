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

			if(isset($_POST['modificar'])){
				if(isset($_POST["nombre"])){
					$nombre = $_POST["nombre"];
				}
	
				if(isset($_POST["id_pista"])){
					$id_pista = $_POST["id_pista"];
				}
	
				if(empty($nombre) || empty($id_pista)) {
					echo "<h3 style='color: red;'> Faltan campos por rellenar en el formulario. </h3>";
				} else {
					modificar_pista($con, $id_pista, $nombre);
					echo "<h3 style='color: green;'> Pista modificada con éxito. </h3>";
				}
			} else {
				if(isset($_GET["id_pista"])){
					$id_pista = $_GET["id_pista"];
				}

				if(empty($id_pista)) {
					echo "<h3 style='color: red;'> Se ha producido un error, por favor intentelo de nuevo. </h3>";
				} else {
					$pista = obtener_pista_id($con, $id_pista);
					$num_filas = obtener_num_filas($pista);
					if($num_filas == 0){
						echo "<h3 style='color: red;'> No se ha encontrado la pista especificado </h3>";
					}
					else{
						$info = obtener_info($pista);
						extract($info);

						echo "<h2> MODIFICAR PISTA </h2>";

						echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>
								<input type='hidden' name='id_pista' value='$id_pista'>
								Nombre: <input type='text' name='nombre' value='$nombre'><br>
								<input type='submit' name='modificar' value='Modificar'></form>";
						echo "<hr></br>";
					}
				}
			}

			cerrar_conexion($con);
		?>

		<form action="pistas.php" method="post">
            <input type="submit" value="Volver atrás">
        </form>
	</body>
</html>