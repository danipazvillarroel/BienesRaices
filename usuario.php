<?php

// Importar la conexión
require "includes/config/database.php";
$db = conectarDB();

// Crear un email y password
$email = "correo@correo.com";
$password = "123456";

// Hasheamos el password
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Query para crear la cuenta
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

// Agregarlo a la BBDD  
mysqli_query($db, $query);