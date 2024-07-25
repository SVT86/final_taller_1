<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Alta de Usuario</title>
</head>
<?php
session_start();

// Función para sanitizar datos de entrada
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data));
}

// Función para validar el correo electrónico
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario
    $nombre = sanitizeInput($_POST['nombre']);
    $apellido = sanitizeInput($_POST['apellido']);
    $email = sanitizeInput($_POST['email']);

    // Validar el correo electrónico
    if (!validateEmail($email)) {
        $error_message = 'El correo electrónico no es válido.';
    } else {
        // Nuevo usuario
        $usuario = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email
        ];

        // Guardar el usuario en memoria (variable de sesión)
        if (!isset($_SESSION['usuarios'])) {
            $_SESSION['usuarios'] = [];
        }

        // Asegúrate de no agregar usuarios duplicados
        $isDuplicate = false;
        foreach ($_SESSION['usuarios'] as $existingUser) {
            if ($existingUser['email'] === $email) {
                $isDuplicate = true;
                break;
            }
        }

        if ($isDuplicate) {
            $error_message = 'El usuario con este correo electrónico ya existe.';
        } else {
            $_SESSION['usuarios'][] = $usuario;
            // Redirigir de vuelta al index
            header('Location: index.php');
            exit;
        }
    }
}
?>
<body>
    <div class="container">
        <h2>Alta de Usuario</h2>
        <?php if ($error_message) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
            <a href="alta_usuario.php" class="volver-link">Volver al formulario</a>
        <?php else : ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>

                <input type="submit" value="Crear Usuario">
            </form>
        <?php endif; ?>
        <div class="nav-bar">
            <a href="index.php">Volver</a>
        </div>
    </div>
</body>

</html>