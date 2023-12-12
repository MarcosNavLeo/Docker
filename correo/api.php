<?php
// Conexión a la base de datos
$servername = "datos";
$username = "root";
$password = "1234";
$dbname = "cestas";

require_once "servicioCorreos.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nombre'])) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nombre = $_GET['nombre'];

        // Consulta preparada para evitar inyección de SQL
        $stmt = $conn->prepare("SELECT email, tipo_cesta FROM emails WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $para = $row['email'];
            $cesta = $row['tipo_Cesta'];

            if ($cesta == "con") {
                $tiene = true;
            } else {
                $tiene = false;
            }
        
            $pdf = file_get_contents('http://cestero/apiPdf.php?tiene=' . $tiene);

            if (!empty($para)) {
                $servicioCorreos = new ServicioCorreos();
                $resultado = $servicioCorreos->enviarCorreoConAdjunto($para,$pdf);

                echo json_encode($resultado);
            } else {
                echo "Error: No se encontró una dirección de correo para el nombre proporcionado.";
            }
        } else {
            echo "Error: No se encontró el nombre en la base de datos.";
        }
    } catch (PDOException $e) {
        echo "Error de ejecución: " . $e->getMessage();
    }
} else {
    echo "Error: Se necesita un nombre válido para procesar la solicitud.";
}
?>



