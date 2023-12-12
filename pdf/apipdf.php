<?php
require_once 'generarpdf.php';
// Utilizar la función en la API
$pdfGenerator = new generarpdf();

// Llamar a la función generapdf para obtener el PDF
$pdfContent = $pdfGenerator->generapdf();

echo $pdfContent;