<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
class generarpdf{
    public function generapdf($tipo){
        $dompdf = new Dompdf();
        
        if ($tipo === 'con') {
            $html = '
            <html>
            <head>
                <title>Ejemplo de PDF con cesta</title>
            </head>
            <body>
                <h1>Ejemplo de PDF con cesta</h1>
            </body>
            </html>
            ';
        } elseif ($tipo === 'sin') {
            $html = '
            <html>
            <head>
                <title>Ejemplo de PDF sin cesta</title>
            </head>
            <body>
                <h1>Ejemplo de PDF sin cesta</h1>
            </body>
            </html>
            ';
        } else {
            // Manejar otros tipos o casos
            return null;
        }
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfOutput = $dompdf->output(); // Obtiene el contenido del PDF

        return $pdfOutput;
    }
}