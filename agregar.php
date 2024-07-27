<?php
// 1) Conexión
$conexion = mysqli_connect("127.0.0.1", "root", "");

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// 2) Almacenamos los datos del envío POST
$prenda = $_POST['prenda'];
$marca = $_POST['marca'];
$talle = $_POST['talle'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$pago = $_POST['pago'];

// Verificar que los archivos han sido subidos
$imagen1 = isset($_FILES['imagen1']) && $_FILES['imagen1']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagen1']['tmp_name'])) : NULL;
$imagen2 = isset($_FILES['imagen2']) && $_FILES['imagen2']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagen2']['tmp_name'])) : NULL;
$imagen3 = isset($_FILES['imagen3']) && $_FILES['imagen3']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagen3']['tmp_name'])) : NULL;
// 3) Preparar la orden SQL
$consulta = "INSERT INTO ropa (prenda, marca, talle, precio, descripcion, imagen1, imagen2, imagen3) 
             VALUES ('$prenda', '$marca', '$talle', '$precio', '$descripcion', '$pago', '$imagen1', '$imagen2', '$imagen3')";

// 4) Ejecutar la orden y ingresar datos
mysqli_select_db($conexion, "feria");

if (mysqli_query($conexion, $consulta)) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
}

// Redirigir a index
header('Location: listar.php');

// Cerrar la conexión
mysqli_close($conexion);
?>