<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Listado de Usuarios</title>
</head>
<body>
    <div class="container">
        <h2>Listado de Usuarios</h2>
        
        <?php if (isset($_SESSION['usuarios']) && !empty($_SESSION['usuarios'])): ?>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                </tr>
                <?php foreach ($_SESSION['usuarios'] as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No hay usuarios registrados.</p>
        <?php endif; ?>
        
        <div class="nav-bar">
            <a href="index.php">Volver</a>
        </div>
    </div>
</body>
</html>
