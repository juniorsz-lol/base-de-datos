<?php
session_start();
include_once('./conect.php'); // Incluye el archivo de conexión a la base de datos

// Manejo de la lógica del formulario
$mensaje = ''; // Inicializa la variable mensaje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que los datos estén presentes
    if (isset($_POST['nombre'], $_POST['correo'], $_POST['contraseña'])) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        

        try {
            // Preparar la consulta SQL para insertar datos
            $stmt = $pdo->prepare("INSERT INTO registro (nombre, correo, contraseña) VALUES (?, ?, ?)");
            // Ejecutar la consulta con los valores
            $stmt->execute([$nombre, $correo, $contraseña]);
            $mensaje = 'Formulario enviado y datos guardados correctamente.';
        } catch (PDOException $e) {
            $mensaje = 'Error: ' . $e->getMessage();
        }
    } else {
        $mensaje = 'Error: Todos los campos son obligatorios.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Formulario de contacto" />
    <meta name="author" content="Tu Nombre" />
    <title>Formulario de Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <section class="py-5">
            <div class="container px-5">
                <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Formulario</h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <?php if ($mensaje): ?>
                                <div class="alert alert-info">
                                    <?php echo $mensaje; ?>
                                </div>
                            <?php endif; ?>
                            <form id="customForm" action="" method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre..." required />
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="correo" name="correo" type="email" placeholder="nombre@ejemplo.com" required />
                                    <label for="correo">Correo electrónico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="contraseña" name="contraseña" type="number" placeholder="Ingrese su contraseña..." required />
                                    <label for="contraseña">Contraseña</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Aquí se incluye el contenido de mostrar.php -->
                <?php include_once('./mostrar.php'); ?>
            </div>
        </section>
    </main>
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0">Copyright &copy; Tu Sitio Web 2024</div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
