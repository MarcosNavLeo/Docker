<?php
require_once 'vendor/autoload.php';
require_once 'serviciocorreos.php';

try {
    $conn = new PDO("mysql:host=datos;dbname=ServicioCorreo", "root", "1234");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Consulta SQL para obtener correos de la tabla emails
    $stmt = $conn->query("SELECT para, asunto, mensaje FROM emails WHERE enviado = 0");

    $servicioCorreos = new ServicioCorreos();

    // Iterar sobre los resultados y enviar correos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $para = $row['para'];
        $asunto = $row['asunto'];
        $mensaje = $row['mensaje'];
        // Enviar el correo utilizando la clase ServicioCorreos
        $resultado = $servicioCorreos->enviarCorreoConAdjunto($para, $asunto, $mensaje);

        // Actualizar el estado de enviado a 1 si el correo se envió correctamente
        if ($resultado) {
            $stmtUpdate = $conn->prepare("UPDATE emails SET enviado = 1 WHERE id = :id");
            $stmtUpdate->bindParam(':id', $id);
            $stmtUpdate->execute();
        }
        // Imprimir el resultado
        echo json_encode($resultado);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; 