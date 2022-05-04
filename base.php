<!-- Esto sirve para incluir en este archivo el código de header.php -->
<?php

    /* Este código sirve paa llamar al archivo funciones.php que tiene la función para incluir los archivos que están dentro de la carpeta includes/templates */
    require "includes/funciones.php";

    incluirTemplate("header");
    
?>

    <main class="contenedor seccion">
        <h1>Titulo Página</h1>
    </main>

<?php incluirTemplate("footer"); ?>