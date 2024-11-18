<?php
include_once('./conect.php'); // Incluye el archivo de conexión a la base de datos

try {
    // Preparar la consulta SQL para seleccionar todos los datos de la tabla 'registro'
    $stmt = $pdo->prepare("SELECT * FROM registro");
    $stmt->execute();

    // Fetch todos los resultados
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($contacts) {
        // Desplegar los resultados en una tabla HTML con clases de Bootstrap
        echo "<div class='container mt-4'>";
        echo "<table class='table table-bordered table-striped table-hover'>";
        echo "<thead class='bg-primary text-white'>";
        echo "<tr>";
        echo "<th>id_registro</th>";
        echo "<th>Nombre</th>";
        echo "<th>correo</th>";
        echo "<th>contraseña</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($contacts as $contact) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($contact['id_registro']) . "</td>";  // id_registro es la clave primaria
            echo "<td>" . htmlspecialchars($contact['nombre']) . "</td>";  // Nombres
            echo "<td>" . htmlspecialchars($contact['correo']) . "</td>";  // email
            echo "<td>" . htmlspecialchars($contact['contraseña']) . "</td>";  // Contraseña
            

            // Modal de editar para cada registro
            echo "<div class='modal fade' id='editarModal" . htmlspecialchars($contact['id_registro']) . "' tabindex='-1' aria-labelledby='editarModalLabel" . htmlspecialchars($contact['id_registro']) . "' aria-hidden='true'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='editarModalLabel" . htmlspecialchars($contact['id_registro']) . "'>Editar registro</h5>";
            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            // Formulario para editar los datos del registro
            echo "<form action='./editar.php' method='POST'>";
            echo "<input type='hidden' name='id_registro' value='" . htmlspecialchars($contact['id_registro']) . "'>";
            echo "<div class='mb-3'>";
            echo "<label for='nombre' class='form-label'>Nombre</label>";
            echo "<input type='text' class='form-control' id='nombre' name='nombre' value='" . htmlspecialchars($contact['nombre']) . "' required>";
            echo "</div>";
            echo "<div class='mb-3'>";
            echo "<label for='correo' class='form-label'>Apellido</label>";
            echo "<input type='text' class='form-control' id='correo' name='correo' value='" . htmlspecialchars($contact['correo']) . "' required>";
            echo "</div>";
            
            echo "<div class='mb-3'>";
            echo "<label for='contraseña' class='form-label'>Correo</label>";
            echo "<input type='text' class='form-control' id='contraseña' name='contraseña' value='" . htmlspecialchars($contact['contraseña']) . "' required>";
            echo "</div>";
           
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='container mt-4'><p>No hay registro para mostrar.</p></div>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
