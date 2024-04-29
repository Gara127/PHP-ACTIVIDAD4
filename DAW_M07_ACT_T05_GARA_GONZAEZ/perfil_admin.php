<?php
    require("validacion.php");
    check("admin");
?>

<html>
	<head>
		<title> PERFIL ADMIN </title>
	</head>
	<body>
        <h3 style='color: blue;'> Bienvenido <?php echo $_SESSION['nombre']; ?>! </h3>
        
		<form action="usuarios.php" method="post">
			<input type="submit" value="Gestión de usuarios">
		</form>

        <form action="pistas.php" method="post">
			<input type="submit" value="Gestión de pistas">
		</form>

        <form action="reservas.php" method="post">
			<input type="submit" value="Gestión de reservas">
		</form>

		<form action="logout.php" method="post">
			<input type="submit" value="Logout">
		</form>
	</body>
</html>
