<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laboratorio";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexion erronea: ". $conn->connect_error);
    }

    $sql = "SELECT `nombre`, `apellido1`, `apellido2`, `email`,`login` FROM usuarioslab";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2><em>Usuarios en base de datos</em></h2>";
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Apellido Uno</th><th>Apellido Dos</th><th>Email</th><th>Login</th></tr></div>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>" . "<td>" . $row["apellido1"] . "</td>" . "<td>" . $row["apellido2"] . "</td>" . "<td>" . $row["email"] . "</td>" . "<td>" . $row["login"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "El listado de usuarios esta vacio.";
    }

    $conn->close();

?>

<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Consulta usuarios</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <br>
        <a href="formulario.php" class="volver-inicio">Volver</a>
    </body>
</html>