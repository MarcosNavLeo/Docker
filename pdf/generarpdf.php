<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
class generarpdf{
    public function generapdf(){
        $dompdf = new Dompdf();
        
        $html = '
        <html>
        <head>
            <title>Ejemplo de PDF con Dompdf</title>
        </head>
        <body>
            <h1>Ejemplo de PDF con Dompdf</h1>
        </body>
        </html>
        ';
        
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        
        $dompdf->render();
        
        $pdfOutput = $dompdf->output(); // Obtiene el contenido del PDF

        return $pdfOutput;
    }
}