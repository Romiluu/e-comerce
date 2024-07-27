<?php
// 1) Conexión a la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "feria");

// 2) Almacenar los datos del envío GET
$id = $_GET['id'];

// 3) Preparar la consulta SQL
$consulta = "SELECT * FROM ropa WHERE id=$id";

// 4) Ejecutar la consulta y almacenar el resultado
$respuesta = mysqli_query($conexion, $consulta);

// 5) Transformar el registro obtenido a un array
$datos = mysqli_fetch_array($respuesta);

// 6) Asignar a diferentes variables los valores del array $datos
$prenda = $datos["prenda"];
$marca = $datos["marca"];
$talle = $datos["talle"];
$precio = $datos["precio"];
$imagen1 = $datos['imagen1'];
$imagen2= $datos['imagen2'];
$imagen3 = $datos['imagen3'];
$descripcion = $datos['descripcion'];
$pago=$datos['pago'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Permanent+Marker&family=Poetsen+One&family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head>
<body>
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
                <li><a href="index.html#about">About</a></li>
                <li><a href="index.html#products">Products</a></li>
                <li><a href="login.html">Login adm</a></li>
            </ul>
        </div>
    </header>

    <section class="section card-container" id="products">
        <div class="column content">
            <h2 class="section-title">Detalle de producto</h2>
            <div class="carousel">
                <div class="carousel-images">
                    <img src="data:image/jpg;base64, <?php echo base64_encode($imagen1); ?>" alt="Imagen 1">
                    <img src="data:image/jpg;base64, <?php echo base64_encode($imagen2); ?>" alt="Imagen 2">
                    <img src="data:image/jpg;base64, <?php echo base64_encode($imagen3); ?>" alt="Imagen 3">
                </div>
                <button class="carousel-button prev">&#10094;</button>
                <button class="carousel-button next">&#10095;</button>
            </div>
            <!-- Sección de descripción del producto -->
            <div class="product-description">
                <h3>Descripción del Producto</h3>
                <p><?php echo $descripcion; ?></p>
                <p>Marca: <?php echo $marca; ?></p>
                <p>Talle: <?php echo $talle; ?></p>
                <p>Precio: $<?php echo $precio; ?></p>
                <a href="<?php echo $pago; ?>" class="buy-button">Comprar</a>
            </div>
        </div>
    </section>

    <footer class="section footer">
        <div class="image-container">
            <img src="./assets/vintage3.jpeg" alt="ropa vintage" class="about-image">
            <img src="./assets/wave 2.png" alt="ola" class="footer-wave">
        </div>
        <div class="footer-overlay">
            <h2>Gracias por visitar nuestra tienda</h2>
            <h3>&copy; Moda circular</h3>
        </div>
    </footer>
    <script src="./js/main.js"></script>
</body>
</html>