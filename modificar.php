<?php
// 1) Conexion
$conexion = mysqli_connect("127.0.0.1", "root", "", "feria");

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// 2) Almacenamos los datos del envío GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3) Preparar la SQL
$consulta = "SELECT * FROM ropa WHERE id=$id";

// 4) Ejecutar la orden y almacenamos en una variable el resultado
$respuesta = mysqli_query($conexion, $consulta);

// Verificar si se obtuvo una fila
if (mysqli_num_rows($respuesta) == 0) {
    die("Prenda no encontrada.");
}

// 5) Transformamos el registro obtenido a un array
$datos = mysqli_fetch_array($respuesta);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ropa</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Asegúrate de que esta ruta sea correcta -->
</head>
<body>
<?php
    // 6) Asignamos a diferentes variables los respectivos valores del array $datos.
    $prenda = htmlspecialchars($datos["prenda"]);
    $marca = htmlspecialchars($datos["marca"]);
    $talle = htmlspecialchars($datos["talle"]);
    $precio = htmlspecialchars($datos["precio"]);
    $descripcion = htmlspecialchars($datos["descripcion"]);
    $pago = htmlspecialchars($datos["pago"]);
    $imagen1 = $datos['imagen1'];
    $imagen2 = $datos['imagen2'];
    $imagen3 = $datos['imagen3'];

    // Si en la variable constante $_POST existe un índice llamado 'guardar_cambios' ocurre el bloque de instrucciones.
    if (isset($_POST['guardar_cambios'])) {
        // 2') Almacenamos los datos actualizados del envío POST
        $prenda = mysqli_real_escape_string($conexion, $_POST['prenda']);
        $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
        $talle = mysqli_real_escape_string($conexion, $_POST['talle']);
        $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $pago = mysqli_real_escape_string($conexion, $_POST['pago']);

        // Manejo de archivos de imagen
        $imagen1 = $datos['imagen1'];
        $imagen2 = $datos['imagen2'];
        $imagen3 = $datos['imagen3'];

        if (isset($_FILES['imagen1']) && $_FILES['imagen1']['tmp_name']) {
            $imagen1 = mysqli_real_escape_string($conexion, file_get_contents($_FILES['imagen1']['tmp_name']));
        }
        if (isset($_FILES['imagen2']) && $_FILES['imagen2']['tmp_name']) {
            $imagen2 = mysqli_real_escape_string($conexion, file_get_contents($_FILES['imagen2']['tmp_name']));
        }
        if (isset($_FILES['imagen3']) && $_FILES['imagen3']['tmp_name']) {
            $imagen3 = mysqli_real_escape_string($conexion, file_get_contents($_FILES['imagen3']['tmp_name']));
        }

        // 3') Preparar la orden SQL
        $stmt = $conexion->prepare("UPDATE ropa SET prenda=?, marca=?, talle=?, precio=?, descripcion=?, pago=?, imagen1=?, imagen2=?, imagen3=? WHERE id=?");
        $stmt->bind_param('sssssssssi', $prenda, $marca, $talle, $precio, $descripcion, $pago, $imagen1, $imagen2, $imagen3, $id);

        // 4') Ejecutar la orden y actualizamos los datos
        if ($stmt->execute()) {
            header('Location: listar.php') ;
            exit(); // Asegúrate de que no haya salida después de header()
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
    }
?>
    <header>
        <h1>ShopStore</h1>
        <input type="checkbox" id="menu-btn" class="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <div class="nav-links">
            <ul>
                <li><a href="index.html#home">Home</a></li>
                <li><a href="listar.php">Listar</a></li>
                <li><a href="login.html">Login adm</a></li>
            </ul>
        </div>
    </header>

    <section class="add-item-section">
        <div class="add-item-container">
            <h2>Modificar prenda</h2>
            <p>Ingrese los nuevos datos de la prenda.</p>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="prenda">Tipo de prenda</label>
                    <input type="text" id="prenda" name="prenda" placeholder="Tipo de Prenda" value="<?php echo $prenda; ?>" required>
                </div>
                <div class="input-group">
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" placeholder="Marca" value="<?php echo $marca; ?>" required>
                </div>
                <div class="input-group">
                    <label for="talle">Talle</label>
                    <input type="text" id="talle" name="talle" placeholder="Talle" value="<?php echo $talle; ?>" required>
                </div>
                <div class="input-group">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>" required>
                </div>
                <div class="input-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>" required>
                </div>
                <div class="input-group">
                    <label for="pago">Link de pago</label>
                    <input type="text" id="pago" name="pago" placeholder="pago" value="<?php echo $pago; ?>" required>
                </div>
                <div class="input-group">
                    <label for="imagen1">Imagen 1</label>
                    <?php if ($imagen1): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen1); ?>" alt="Imagen 1" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?>
                    <input type="file" name="imagen1">
                </div>
                <div class="input-group">
                    <label for="imagen2">Imagen 2</label>
                    <?php if ($imagen2): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen2); ?>" alt="Imagen 2" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?>
                    <input type="file" name="imagen2">
                </div>
                <div class="input-group">
                    <label for="imagen3">Imagen 3</label>
                    <?php if ($imagen3): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen3); ?>" alt="Imagen 3" style="max-width: 100px; max-height: 100px;">
                    <?php endif; ?>
                    <input type="file" name="imagen3">
                </div>
                
                <button type="submit" name="guardar_cambios" class="submit-button">Guardar Cambios</button>
                <button type="submit" name="Cancelar" formaction="listar.php" class="submit-button">Cancelar</button>
            </form>
        </div>
    </section>
    <script src="./js/main.js"></script>
</body>
</html>