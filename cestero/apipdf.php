<?php
require_once 'generarpdf.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tiene = $_GET['tiene'];

    $genPdf = new generarpdf();
    $respuesta = $genPdf->generarPdf($tiene);

    echo $respuesta;
}
?>