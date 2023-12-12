<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
class generarpdf{
    public function generarPdf($tiene)
    {
        if ($tiene) {
            $html = '
            <html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            </head>
            <body>
            <dl>
            <h2>ENHORABUENA GANASTE EL JAMON</h2>
            <dd><img src="cestero/todos/jamon-iberico-bellota-.jpg" width="100px" height="100px"></dd>
            </dl>
            </body>
            </html>';
        } else {
            $html = '
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        </head>
        <body>
        <dl>
        <dd>NO TIENES Jamón Pata Negra</dd>
        </dl>
        </body>
        </html>';

        }

        $mipdf = new Dompdf();
        $mipdf->setpaper("A4", "portrait");
        $mipdf->loadhtml($html);
        $mipdf->render();
        $pdf = $mipdf->output();
        $filename = "fichero.pdf";
        file_put_contents($filename, $pdf);
        return $pdf;
    }
}