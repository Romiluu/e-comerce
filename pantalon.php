<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>camperas</title>
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
            <h2 class="section-title">Descubre nuestra seleccion de Pantalones</h2>
            <div class="container">
                <?php
                // 1) Conexión
                $conexion = mysqli_connect("127.0.0.1", "root", "");
                mysqli_select_db($conexion, "feria");

                // 2) Preparar la orden SQL
                $consulta = "SELECT * FROM ropa WHERE prenda='pantalon'";

                // 3) Ejecutar la orden y obtener los registros
                $datos = mysqli_query($conexion, $consulta);

                // 4) Recorrer todos los registros y generar una tarjeta (card) para cada uno
                while ($reg = mysqli_fetch_array($datos)) { ?>
                    <a href="productos.php?id=<?php echo $reg['id']; ?>">
                    <div class="card">
                            <img src="data:image/jpg;base64, <?php echo base64_encode($reg['imagen1']); ?>" alt="Product Image">
                            <div class="overlay">
                                <h3 ><?php echo ucwords($reg['prenda']); ?></h3>
                                <h5>Marca: <?php echo ucwords($reg['marca']); ?></h5> <!-- Agregado para mostrar la marca -->
                                <h5>$<?php echo $reg['precio']; ?></h5>
                                <a href="productos.php?id=<?php echo $reg['id'];?>">
                            </div>
                        </div>
                    </a>
                <?php } ?>
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
</body>
</html>