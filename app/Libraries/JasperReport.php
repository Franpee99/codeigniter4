<?php

namespace App\Libraries;

use PHPJasper;
use PHPJasper\PHPJasper as PHPJasperPHPJasper;

class JasperReport
{
    protected $jasper;
    protected $tempPath;

    public function __construct()
    {
        require_once(APPPATH . "ThirdParty/phpjasper/src/PHPJasper.php");
        $this->jasper = new PHPJasperPHPJasper();

        // Carpeta temporal donde se generarán los informes
        $this->tempPath = WRITEPATH . 'reports';
    }

    public function generarResumenCarga($routes, $dateDelivery, $mode = 'download', $ext = 'pdf')
    {
        $input = WRITEPATH . 'reports/ResumenDeCarga.jasper';  // Ruta al .jasper compilado
        $output = $this->tempPath;  // Carpeta de salida para el informe generado

        // Asegúrate de que los parámetros no tengan espacios extra entre -P y el valor
        $options = [
            'format' => [$ext],
            'params' => [
                'FechaServicio' => $this->formatearFecha($dateDelivery),  // Usamos FechaServicio
                'Ruta'          => $routes,
                'idEmpresa'     => 1,  // ID fijo como se indicaba
            ],
            'db_connection' => [
                'driver'   => 'mysql',
                'username' => 'cgm547_test',
                'password' => 'ut3EL!!4jR3#',
                'host'     => 'ns1.eurosystemhosting.com',
                'database' => 'cgm547_test',
                'port'     => '3306',
            ]
        ];

        // Ejecutar Jasper
        $this->jasper->process($input, $output, $options)->execute();

        // Ruta completa del archivo generado
        $filePath = "{$output}/ResumenDeCarga.{$ext}";

        if (file_exists($filePath)) {
            return $filePath;
        }

        return false;
    }

    protected function formatearFecha($fecha)
    {
        return date('Y-m-d', strtotime($fecha));  // Formatea la fecha correctamente
    }
}
