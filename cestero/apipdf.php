<?php
require_once 'generarpdf.php';

$pdfGenerator = new generarpdf();

if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $tipo = obtenerTipoDesdeBD($nombre);

    if ($tipo === 'con' || $tipo === 'sin') {
        $pdfContent = $pdfGenerator->generapdf($tipo);

        if ($pdfContent !== null) {
            echo $pdfContent;
            exit();
        } else {
            echo "Error al generar el PDF";
        }
    } else {
        echo "Tipo no reconocido";
    }
}
function obtenerTipoDesdeBD($nombre) {
    try {
        $conn = new PDO("mysql:host=datos;dbname=ServicioCorreo", "root", "1234");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT tipo_cesta FROM emails WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['tipo_cesta'];
        } else {
            return null; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; 
    }
}