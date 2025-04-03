<?php

namespace App\Controllers;

use App\Libraries\JasperReport;

class Informe extends BaseController
{
    public function resumenCarga()
    {
        $jasper = new JasperReport();

        // Definir los valores manualmente
        $routes = '3,4,8';  // Ruta
        $fecha  = '2024-04-24';  // Fecha de servicio

        // Llamar a la función que genera el informe
        $pdfPath = $jasper->generarResumenCarga($routes, $fecha);

        if (!$pdfPath) {
            return $this->response->setStatusCode(500)->setBody('Error generando el informe');
        }

        // Responder con el archivo PDF generado
        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="ResumenDeCarga.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
