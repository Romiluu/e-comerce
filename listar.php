<?php
// 1) Conexión a la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "feria");

// 2) Preparar la consulta SQL para listar todos los productos
$consulta = 'SELECT * FROM ropa';

// 3) Ejecutar la consulta y obtener los resultados
$respuesta = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de ropa</title>
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

    <section class="table-container">
        <h2 class="title-listar">Lista de ropa</h2>
        <div class="button-container">
        <a href="index.html" class="buy-button">Inicio</a>
        <a href="listar.php" class="buy-button">Listar ropa</a>
        <a href="agregar.html" class="buy-button">Agregar ropa</a>
    </div>
        <p>La siguiente lista muestra los datos de la ropa actualmente en stock.</p>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TIPO DE PRENDA</th>
                    <th>MARCA</th>
                    <th>TALLE</th>
                    <th>PRECIO</th>
                    <th>DESCRIPCION</th>
                    <th>IMAGEN</th>
                    <th>EDITAR</th>
                    <th>BORRAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 4) Mostrar los datos de cada registro
                while ($reg = mysqli_fetch_array($respuesta)) { ?>
                    <tr>
                        <td><?php echo $reg['id']; ?></td>
                        <td><?php echo $reg['prenda']; ?></td>
                        <td><?php echo $reg['marca']; ?></td>
                        <td><?php echo $reg['talle']; ?></td>
                        <td><?php echo $reg['precio']; ?></td>
                        <td><?php echo $reg['descripcion']; ?></td>
                        <td><img src="data:image/png;base64, <?php echo base64_encode($reg['imagen1']); ?>" alt="" width="100px" height="100px"></td>
                        <td><a href="modificar.php?id=<?php echo $reg['id']; ?>">Editar</a></td>
                        <td><a href="borrar.php?id=<?php echo $reg['id']; ?>" onclick="return confirmarBorrado();">Borrar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

    <footer class="section footer">
        <div class="image-container">
            <img src="./assets/vintage3.jpeg" alt="ropa vintage" class="about-image">
            <img src="./assets/wave3.png" alt="ola" class="footer-wave">
        </div>
        <div class="footer-overlay">
            <h2>Gracias por visitar nuestra tienda</h2>
            <h3>&copy; Moda circular</h3>
        </div>
    </footer>
    <script src="./js/main.js"></script>
</body>
</html>