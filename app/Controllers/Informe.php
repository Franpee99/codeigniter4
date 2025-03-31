<?php

namespace App\Controllers;

use App\Libraries\JasperReport;

class Informe extends BaseController
{
    public function prueba()
    {
        $jasper = new JasperReport();
        $pdfPath = $jasper->generarPDF('FacturaVenta');

        return $this->response
                    ->setContentType('application/pdf')
                    ->setBody(file_get_contents($pdfPath));
    }
}
