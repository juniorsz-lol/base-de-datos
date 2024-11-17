<?php
define('SERVIDOR', 'localhost');
define('NOMBRE_BD', 'Usuarios');
define('USUARIO', 'root');
define('CLAVE', '');
$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

try {
    // Conectar a la base de datos usando PDO
    $pdo = new PDO('mysql:host=' . SERVIDOR . ';dbname=' . NOMBRE_BD, USUARIO, CLAVE, $opciones);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<p class="success">Conexión exitosa a la base de datos.</p>';
} catch (PDOException $e) {
    // Manejar error en la conexión
    echo '<p class="error">Error en la conexión: ' . htmlspecialchars($e->getMessage()) . '</p>';
    die();
}

// Consulta para obtener los usuarios desde la base de datos
try {
    $stmt = $pdo->query("SELECT id_registro, nombre, email, comtaseña FROM registro");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtenemos los datos en un array asociativo
} catch (PDOException $e) {
    echo 'Error al obtener los usuarios: ' . $e->getMessage();
    die();
}
?>