<?php
require_once 'vendor/autoload.php';
require_once 'serviciocorreos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = $_POST['nombre'];
        $conn = new PDO("mysql:host=datos;dbname=ServicioCorreo", "root", "1234");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para obtener el correo asociado al nombre
        $stmt = $conn->prepare("SELECT email FROM emails WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        // Verificar si se encontró el nombre en la base de datos
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $correoDestino = $row['email'];

            echo "<h1>El nombre $nombre está en la base de datos</h1>";

            $servicioCorreos = new ServicioCorreos();
            $resultado = $servicioCorreos->enviarCorreoConAdjunto($correoDestino);

            if ($resultado) {
                echo "<p>Correo enviado correctamente a $correoDestino</p>";
            } else {
                echo "<p>Error al enviar el correo</p>";
            }
        } else {
            echo "<h1>El nombre $nombre no está en la base de datos</h1>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>