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

    public function generarDetalleVenta($idComercial, $desde, $hasta)
    {
        $nombre      = 'DetalleVentaxPedido';
        $input       = WRITEPATH . "reports/{$nombre}.jasper";
        $outputDir   = WRITEPATH . "reports/{$nombre}_salida";
        $outputPath  = $outputDir . '.pdf';
        $resourceDir = WRITEPATH . 'reports';
        $jasperPath  = APPPATH . 'ThirdParty/phpjasper/bin/jasperstarter/bin/jasperstarter.exe';
        $jdbcDir     = APPPATH . 'ThirdParty/phpjasper/bin/jasperstarter/jdbc';

        $params = [
            'IdComercial' => $idComercial,
            'DesdeFecha'  => $desde,
            'HastaFecha'  => $hasta,
        ];

        $paramString = '-P ';
        foreach ($params as $key => $value) {
            $paramString .= "{$key}=\"{$value}\" ";
        }

        $command = "\"{$jasperPath}\" process \"{$input}\""
                . " -o \"{$outputDir}\""
                . " -f pdf"
                . " -t mysql"
                . " -u test_newater"
                . " -p \"23u86Xvd&\""
                . " -H ns1.eurosystemhosting.com"
                . " -n test_newater"
                . " -P 3306"
                . " --jdbc-dir \"{$jdbcDir}\""
                . " -r \"{$resourceDir}\""
                . " {$paramString} --debug";

        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        echo "<pre>";
        echo "🟢 Comando ejecutado:\n$command\n\n";
        echo "📤 Salida de JasperStarter:\n" . implode("\n", $output) . "\n\n";
        echo "🔁 Código de salida: $returnVar\n";

        if (!file_exists($outputPath)) {
            echo "\n❌ El archivo PDF no fue generado: $outputPath\n";
        } else {
            echo "\n✅ El archivo PDF fue generado correctamente: $outputPath\n";
        }

        echo "</pre>";
        exit;
    }


}
