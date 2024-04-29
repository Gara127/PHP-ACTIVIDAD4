<?php
    // Iniciar la sesión para acceder a las variables de sesión
    session_start();

    function check($pagina){
        // Verificar si existe una sesión y si hay información en la sesión
        if(isset($_SESSION['tipo']) && isset($_SESSION['nombre']) && isset($_SESSION['id_usuario'])){
            
            // Si no es un usuario, redirigir a la página de admin
            if($_SESSION['tipo'] == 0 && $pagina == "usuario"){
                header('Location: perfil_admin.php');
                exit();
            }

            // Si no es un administrador, redirigir a la página de usuario
            if($_SESSION['tipo'] == 1 && $pagina == "admin"){
                header('Location: perfil_usuario.php');
                exit();
            }

        } else {
            // Si no hay información de sesión, redirigir al usuario al inicio de sesión
            header('Location: login.html');
            exit();
        }
    }
?>