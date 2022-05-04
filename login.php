<!-- Esto sirve para incluir en este archivo el código de header.php -->
<?php

    // Conectamos a la BBDD
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    // Acá autenticamos al usuario
    if($_SERVER['REQUEST_METHOD'] ==="POST") {

        $email = mysqli_real_escape_string ($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password) {
            $errores[] = "El Password es obligatorio";
        }

        if(empty($errores)) {
            // Revisamos si el usario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);

            /* Acá vamos a revisar que existe el usuario a través de nums_rows, o sea, si hay un resultado a la consulta, y si existe verificamos si el password es idéntico */
            if( $resultado->num_rows ) {
                
                // Revisamos si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificamos si el password es correcto o no
                $autenticado = password_verify($password, $usuario['password']);

                if($autenticado) {
                    // El usuario está autentica
                    /* session_start() sirve para iniciar la sesión y poder dejar autentica al usaurio*/
                    session_start();

                    // LLenar el arreglo de la sesión
                    /* A esta superglobal podemos llenarla de información para después poder ir seleccionando lo que necesitemos, en este caso creamos $_SESSION['usuario'] y le asignamos el mail del usuario */
                    /* También creamos el login = true para que esto se mantenga hasta que cerremos la sesión */
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "el password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }


    /* Este código sirve paa llamar al archivo funciones.php que tiene la función para incluir los archivos que están dentro de la carpeta includes/templates */
    require "includes/funciones.php";

    incluirTemplate("header");
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">

            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>


    </main>

<?php incluirTemplate("footer"); ?>