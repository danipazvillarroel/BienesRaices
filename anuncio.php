<!-- Esto sirve para incluir en este archivo el código de header.php -->
<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: /");
    }

    require "includes/config/database.php";
    $db = conectarDB();

    // Consultar la BBDD
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    // Obtener los resultados
    $resultado = mysqli_query($db, $query);

    /* nums_rows viene de la variable $resultado. Si existe el id de la consulta, aparee nums_rows = 1, sono aparece 0, entonces hacemos un if para que si no existe el id al intentar ver la propiedad nos lleve a la página principal */
    /* La sintaxis de flecha en php es lo forma de acceder en los Objetos, y lo que trae mysqli_query es un objeto */
    if($resultado->num_rows === 0) {
        header("Location: /");
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    /* Este código sirve paa llamar al archivo funciones.php que tiene la función para incluir los archivos que están dentro de la carpeta includes/templates */
    require "includes/funciones.php";

    incluirTemplate("header");
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">
        
        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

    <?php
    
        mysqli_close($db);

        incluirTemplate("footer");
    ?>