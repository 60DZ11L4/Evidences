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
    // Construye la consulta SQL vulnerable a inyección
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Ejecuta la consulta
    $result = $conn->query($sql);

    // Verifica si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
	header("Location: https://geekprank.com/hacker/", true, 301);
	echo "Login exitoso";
    } else {
	header("Location: https://geekprank.com/fake-virus/", true, 301);
	echo "Login Fallido";
    }
    // Close the database connection
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
