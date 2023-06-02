<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servicio = $_POST["servicio"];

    if ($_POST["accion"] == "encender") {
        // Verificar si el servicio ya está encendido
        $salida = shell_exec("systemctl is-active " . $servicio);
        if (trim($salida) == "active") {
            echo "<script>alert('El servicio ya está encendido');</script>";
        } else {
            // Ejecutar el comando para encender el servicio sin proporcionar una contraseña interactivamente
            $comando = "sudo -n systemctl start " . $servicio;
            $salida = shell_exec($comando);
            // Aquí puedes realizar otras acciones o mostrar un mensaje de éxito
        }
    } elseif ($_POST["accion"] == "apagar") {
        // Verificar si el servicio ya está apagado
        $salida = shell_exec("systemctl is-active " . $servicio);
        if (trim($salida) == "inactive") {
            echo "<script>alert('El servicio ya está apagado');</script>";
        } else {
            // Ejecutar el comando para apagar el servicio sin proporcionar una contraseña interactivamente
            $comando = "sudo -n systemctl stop " . $servicio;
            $salida = shell_exec($comando);
            // Aquí puedes realizar otras acciones o mostrar un mensaje de éxito
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Control de Servicio</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="servicio">Nombre del servicio:</label>
        <input type="text" name="servicio" id="servicio" required>
        <br>
        <input type="hidden" name="accion" value="encender">
        <input type="submit" value="Encender">
    </form>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="servicio">Nombre del servicio:</label>
        <input type="text" name="servicio" id="servicio" required>
        <br>
        <input type="hidden" name="accion" value="apagar">
        <input type="submit" value="Apagar">
    </form>
</body>
</html>
