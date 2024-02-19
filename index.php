<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokens</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/logo-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./estilos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!--- conexion base de datos --->
    <?php
        require './php/conexion.php';

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener los datos
        $sql = "SELECT * FROM Tokens ORDER BY id DESC LIMIT 10";
        $result = $conn->query($sql);
        $conn->close();
    ?>

    <!--- funcion para eliminar los tokens --->
    <?php
        require './php/conexion.php';
        date_default_timezone_set('America/Bogota'); // Establecer la zona horaria a bogota
        $hora_actual = date("H:i"); // Obtener la hora actual (sin segundos)
        $otra_hora = "22:00"; // Hora que quieres comparar
        $eliminacion_realizada = false; // Variable para rastrear si la eliminación ya se hizo

        if ($hora_actual == $otra_hora && !$eliminacion_realizada) {
            $consulta = "DELETE FROM Tokens";

            // Ejecutar la consulta
            if (mysqli_query($conn, $consulta)) {
                $eliminacion_realizada = true; // Marcar que la eliminación ya se realizó
            } else {
                echo "Error al eliminar datos: " . mysqli_error($conn);
            }
        } elseif ($hora_actual != $otra_hora ) {
            $eliminacion_realizada = false; // Reiniciar la variable si la hora no coincide
        }
        $conn->close();
    ?>

    <!--- contenedor --->
    <div class="container">
        <h1>Tokens</h1>
        <!--- botones --->
        <div class="btn">
            <button data-campaign="token 1">TOKEN 1</button>
            <button data-campaign="token 2">TOKEN 2</button>
            <button data-campaign="portabilidad">PORTABILIDAD</button>
            <button data-campaign="token 5">TOKEN 5</button>
            <button data-campaign="token 6">TOKEN 6</button>
            <button data-campaign="token 7">TOKEN 7</button>
            <button data-campaign="azul">AZUL</button>
            <button data-campaign="morado">MORADO</button>
            <button data-campaign="delete" id="deleteButton">ELIMINAR</button>
        </div>
        <!--- tabla --->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Campaña</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $result->fetch_assoc()) { ?>
                    <tr scope="row">
                        <td><?php echo $fila['campaña']; ?></td>
                        <td><?php echo $fila['codigo']; ?></td>
                        <td><?php echo $fila['hora']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>