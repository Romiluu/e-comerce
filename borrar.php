<?php
// 1) Conexión a la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "feria");

// 2) Almacenamos los datos del envío GET
$id = $_GET['id'];

// 3) Preparar la orden SQL
$consulta = "DELETE FROM ropa WHERE id = $id";

// 4) Ejecutar la orden y eliminamos el registro seleccionado
if (mysqli_query($conexion, $consulta)) {
    // Redirigir a la página de listar ropa
    header('Location: listar.php');
} else {
    echo "Error al eliminar la prenda: " . mysqli_error($conexion);
}

// 5) Cerrar la conexión
mysqli_close($conexion);
?>