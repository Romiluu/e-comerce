<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["user"] ?? '';
    $pass = $_POST["pass"] ?? '';

    $usuario = "admin";
    $contrasenia = "1234";

    if ($usuario === $user && $contrasenia === $pass) {
        header("Location: listar.php");
        exit();
    } else {
        header("Location: error.html");
        exit();
    }
} else {
    echo "No se enviaron datos.";
}
?>