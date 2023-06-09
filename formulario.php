<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST['nombre'];
        $apellidoUno = $_POST['apellidoUno'];
        $apellidoDos = $_POST['apellidoDos'];
        $correo = $_POST['correo'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Comprobar en PHP opcional
        if (empty($nombre) || empty($apellidoUno) || empty($apellidoDos) || empty($correo) || empty($login) || empty($password)) {
            die("Debe completar los campos obligatorios.");
        }

        // Comprobar password correcta (longitud)
        if (strlen($password) < 4 || strlen($password) > 8) {
            die("Password debe tener entre 4 y 8 caracteres.");
        }

        // Comprobar formato correo correcto
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            die("El formato de correo insertado no es correcto.");        
        }

        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laboratorio";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexion erronea: ". $conn->connect_error);
        }

        $sql = "SELECT 'nombre' FROM usuarioslab WHERE `login` = '$login'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            die("Login registrado. Utilice otro diferente");
        }
                
        $sql = "SELECT 'nombre' FROM usuarioslab WHERE `email` = '$correo'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            die("El mail que intenta utilizar, esta registrado. Utilice un mail diferente.");
        }

        $sql = "INSERT INTO `usuarioslab`(`nombre`, `apellido1`, `apellido2`, `email`,`login`,`password`) VALUES ('$nombre', '$apellidoUno', '$apellidoDos','$correo','$login','$password')";

        if ($conn->query($sql)===TRUE) {
            echo "<h2><em> Registro hecho </em></h2>";
        } else {
            echo "Error: " . $sql . "<br>" .$conn->error;
        }

        $conn->close();
    }
?>

<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Registro realizado</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <h2><em> Menu </em></h2>
        <br>
        <a href="formulario.html" class="volver-inicio">Volver</a>
        <a href="consulta.php" class="volver-inicio">Consulta</a>
    </body>
</html>