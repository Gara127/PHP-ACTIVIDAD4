<?php
    $host = "localhost";
    $user = "root";
    $pass = "Cocacola01.";
    $db_name = "padel";

    function conectar(){
        $con = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"]) or die("Error al conectar con la base de datos");
        crear_bdd($con);
        mysqli_select_db($con, $GLOBALS["db_name"]);
        crear_tabla_usuario($con);
        crear_tabla_pista($con);
        crear_tabla_reserva($con);
        return $con;
    }

    function crear_bdd($con){
        mysqli_query($con, "create database if not exists padel;");
    }

    function crear_tabla_usuario($con){
        mysqli_query($con, "create table if not exists usuario(
                    id_usuario int primary key auto_increment, 
                    nombre varchar(225), 
                    pass varchar(225), 
                    tipo int check(tipo in (0,1)))
                    ");

        // Verificar si la tabla está vacía
        $usuarios = mysqli_query($con, "select * from usuario");
        $num_filas = obtener_num_filas($usuarios);

        // Si no hay registros, insertar un usuario administrador
        if ($num_filas == 0) {
            $tipo = 0;
            $nombre = 'admin';
            $password = 'admin';

            // Insertar el usuario administrador
            mysqli_query($con, "insert into usuario (nombre, pass, tipo) values ('$nombre', '$password', $tipo)");
        }
    }

    function crear_tabla_pista($con){
        mysqli_query($con, "create table if not exists pista(
                    id_pista int primary key auto_increment, 
                    nombre varchar(255))
                    ");
    }

    function crear_tabla_reserva($con){
        mysqli_query($con, "create table if not exists reserva(
                    id_reserva int primary key auto_increment,
                    id_usuario int,
                    id_pista int,
                    turno int, 
                    CONSTRAINT fk_usuario FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario),
                    CONSTRAINT fk_pista FOREIGN KEY(id_pista) REFERENCES pista(id_pista)) 
                    ");
    }

    // AUX

    function cerrar_conexion($con){
        mysqli_close($con);
    }

    function obtener_info($resultado){
        return mysqli_fetch_array($resultado);
    }

    function obtener_num_filas($resultado){
        return mysqli_num_rows($resultado);
    }

    // USUARIOS

    function obtener_usuarios($con){
        $consulta = "select * from usuario";
        $usuarios = mysqli_query($con, $consulta);
        return $usuarios;      
    }

    function obtener_usuario_id($con, $id_usuario){
        $consulta = "select * from usuario where id_usuario=$id_usuario";
        $usuario = mysqli_query($con, $consulta);
        return $usuario;      
    }

    function obtener_usuario($con, $nombre, $password){
        $consulta = "select * from usuario where nombre='$nombre' and pass='$password'";
        $usuario = mysqli_query($con, $consulta);
        return $usuario;      
    }

    function crear_usuario($con, $tipo, $nombre, $password){
        mysqli_query($con, "insert into usuario(nombre, pass, tipo) values('$nombre', '$password', $tipo)");
    }

    function modificar_usuario($con, $id_usuario, $tipo, $nombre, $password){
        $consulta = "update usuario set tipo=$tipo, nombre='$nombre', pass='$password' where id_usuario=$id_usuario";
        mysqli_query($con, $consulta);
    }

    function borrar_usuarios($con, $codigos){
        $consulta = "delete from usuario where id_usuario in (".implode(", ", $codigos).")";
        mysqli_query($con, $consulta);
    }

    // PISTAS

    function obtener_pistas($con){
        $consulta = "select * from pista";
        $pistas = mysqli_query($con, $consulta);
        return $pistas;      
    }

    function obtener_pista_id($con, $id_pista){
        $consulta = "select * from pista where id_pista=$id_pista";
        $pista = mysqli_query($con, $consulta);
        return $pista;
    }

    function crear_pista($con, $nombre){
        mysqli_query($con, "insert into pista(nombre) values('$nombre')");
    }

    function modificar_pista($con, $id_pista, $nombre){
        $consulta = "update pista set nombre='$nombre' where id_pista=$id_pista";
        mysqli_query($con, $consulta);
    }

    function borrar_pistas($con, $codigos){
        $consulta = "delete from pista where id_pista in (".implode(", ", $codigos).")";
        mysqli_query($con, $consulta);
    }

    // RESERVAS

    function obtener_reservas($con){
        $consulta = "select * from reserva";
        $reservas = mysqli_query($con, $consulta);
        return $reservas;      
    }

    function obtener_reservas_usuario($con, $id_usuario){
        $consulta = "select * from reserva where id_usuario=$id_usuario";
        $reservas = mysqli_query($con, $consulta);
        return $reservas;      
    }

    function obtener_reserva($con, $id_pista, $turno){
        $consulta = "select * from reserva where id_pista=$id_pista and turno=$turno";
        $reserva = mysqli_query($con, $consulta);
        return $reserva;
    }

    function crear_reserva($con, $id_usuario, $id_pista, $turno){
        mysqli_query($con, "insert into reserva(id_usuario, id_pista, turno) values($id_usuario, $id_pista, $turno)");
    }

    function borrar_reservas($con, $codigos){
        $consulta = "delete from reserva where id_reserva in (".implode(", ", $codigos).")";
        mysqli_query($con, $consulta);
    }

    function borrar_todas_reservas($con){
        $consulta = "delete from reserva";
        mysqli_query($con, $consulta);
    }

?>