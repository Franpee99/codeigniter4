<?php

namespace App\Libraries;

class JasperReport
{
    public function generarPDF($nombre)
    {
        $input       = WRITEPATH . "reports/{$nombre}.jrxml";
        $outputDir   = WRITEPATH . "reports/{$nombre}_salida";
        $outputPath  = $outputDir . '.pdf';
        $resourceDir = WRITEPATH . 'reports';
        $jasperPath  = APPPATH . 'ThirdParty/phpjasper/bin/jasperstarter/bin/jasperstarter.exe';
        $jdbcDir     = APPPATH . 'ThirdParty/phpjasper/bin/jasperstarter/jdbc';

        // Parámetros del informe
        $params = [
            'Serie'     => 'F24',
            'Numero'    => '002834',
            'IdCompany' => 1,
        ];

        // Convertimos los parámetros al formato -P clave="valor"
        $paramString = '';
        if (!empty($params)) {
            $paramString = '-P ';
            foreach ($params as $key => $value) {
                $paramString .= "{$key}=\"{$value}\" ";
            }
        }

        // Construimos el comando completo
        $command = "\"{$jasperPath}\" --locale en process \"{$input}\" -o \"{$outputDir}\" -f pdf"
                 . " -t mysql -u cgm547_test -p \"ut3EL!!4jR3#\" -H ns1.eurosystemhosting.com -n cgm547_test -P 3306"
                 . " --jdbc-dir \"{$jdbcDir}\""
                 . " -r \"{$resourceDir}\""
                 . " {$paramString}";

        try {
            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                dd('Error al ejecutar JasperStarter:', $command, $output);
            }

        } catch (\Throwable $e) {
            dd('Excepción:', $e->getMessage());
        }

        return $outputPath;
    }
}
