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

    public function detalle()
    {
        $id     = $this->request->getGet('id_comercial');
        $desde  = $this->request->getGet('desde') ?? '2025-01-01';
        $hasta  = $this->request->getGet('hasta') ?? '2025-12-28';

        $jasper = new \App\Libraries\JasperReport();
        $pdfPath = $jasper->generarDetalleVenta($id, $desde, $hasta);

        return $this->response
                    ->setContentType('application/pdf')
                    ->setHeader('Content-Disposition', 'inline; filename="detalle.pdf"')
                    ->setBody(file_get_contents($pdfPath));
    }

}
