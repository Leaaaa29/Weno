<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación</title>
</head>
<body>

<h1><center>Calculos de los residentes</center></h1>

<?php

$filename = 'personas.csv';
$persons = [];
if (($handle = fopen($filename, 'r')) !== false) {

    fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        $persons[] = [
            'nombre' => $data[0], 
            'apellido' => $data[1],
            'edad' => $data[2], 
            'sexo' => $data[3],
            'pais de origen' => $data[4],
            'estado civil' => $data[5],
            'cantidad de hijos' => $data[6],
            'ocupacion' => $data[7],
            'ciudad' => $data[8],
            'tipo de vivienda' =>$data[9],
        ];
    }
    fclose($handle);
}

$nombre = array_column($persons, 'nombre'); 
$apellido = array_column($persons, 'apellido');
$edad = array_column($persons, 'edad'); 
$sexo = array_column($persons, 'sexo'); 
$pais = array_column($persons, 'pais de origen'); 
$estado = array_column($persons, 'estado civil');
$hijos = array_column($persons, 'cantidad de hijos');
$ocupacion = array_column($persons, 'ocupacion');
$ciudad = array_column($persons, 'ciudad');
$vivienda = array_column($persons, 'tipo de vivienda');

$edad_min = min($edad); 
$edad_max = max($edad); 
$edad_prom = array_sum($edad) / count($edad);
$total_hijos = count(array_filter($hijos, fn($g) => $g));
$masculinos = count(array_filter($sexo, fn($g) => $g === 'M'));
$femeninos = count(array_filter($sexo, fn($g) => $g === 'F'));
$solteros_total = count(array_filter($estado, fn($g) => $g == 'soltera'));
$casados_total = count(array_filter($estado, fn($g) => $g == 'casado'));
$divorciados = count(array_filter($estado, fn($g) => $g == 'divorciada'));
$paises = array_count_values($pais);
$ocupaciones = array_count_values($ocupacion);

echo "<h2>Calculos estadisticos</h2>";
echo "<p>Edad minima: $edad_min</p>";
echo "<p>Edad maxima: $edad_max</p>";
echo "<p>Promedio de edad: " . round($edad_prom, 2) . "</p>";
echo "<p>Cantidad total de hijos: $total_hijos</p>";
echo "<p>Cantidad de hombres: $masculinos</p>";
echo "<p>Cantidad de mujeres: $femeninos</p>";
echo "<h2>Estado civil de las personas</h2>";
echo "<p>Solteros: $solteros_total</p>";
echo "<p>Casados: $casados_total</p>";
echo "<p>divorciados: $divorciados</p>";

echo "<h2>Distribucion por nacionalidad</h2>";
foreach ($paises as $pais => $count) {
    echo "<p>$pais: $count</p>";
}

echo "<h2>Ocupaciones</h2>";
foreach ($ocupaciones as $ocupacion => $count) {
    echo "<p>ocupaciones $ocupacion: $count</p>";
}

?>

</body>
</html>
