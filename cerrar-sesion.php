<?php 

    session_start();

    $_SESSION = [];

    header('Location: /');

    /* Lo que hacemos en está página es que cuando el usuario toque el botón de cerrar sesión, lo va a traer a está página, el arreglo de la superglobal con los datos de su sesión se transforma en un arreglo vación, o sea, no tiene más sus datos, o sea, no está más logueado, y se lo redirige a la raíz del proyecto */