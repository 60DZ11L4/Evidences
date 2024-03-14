<?PHP

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection credentials
    $servername = 'localhost';
    $db_username = 'admin';
    $db_password = 'ubuntu2021';
    $dbname = 'hacking';

    // Conexión a la base de datos
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Preparar la consulta SQL con parámetros
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("ss", $username, $password);

    // Asignar valores a las variables $username y $password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Si hay resultados, el login es exitoso
        header("Location: https://geekprank.com/hacker/", true, 301);
        echo "Login exitoso";
    } else {
        // Si no hay resultados, el login falló
        header("Location: https://geekprank.com/fake-virus/", true, 301);
        echo "Login fallido";
    }

    // Cerrar la consulta preparada y la conexión
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <!--Form Login-->
        <form id="login-post" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group" style="text-align: center">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
