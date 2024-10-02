<?php
$archivo = fopen("personas.csv", "r");

$persons = [];

while (($data = fgetcsv($archivo)) !== false) {
    if ($data[0] !== "nombre") { 
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
            'tipo de vivienda' => $data[9],
        ];
    }
}
fclose($archivo);

$resultados = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre'])) {
    $nombreInput = strtolower(trim($_POST['nombre']));
    foreach ($persons as $person) {
        if (strtolower($person['nombre']) == $nombreInput) {
            $resultados[] = $person;
        }
    }
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
</head>
<body>
<h1><center>Busqueda del residente</center></h1>
<form method="post">
    <p> ingrese el nombre del residente <input type='text' name='nombre'></p>
    <p> ingrese el apellido del residente <input type='text' name='apellido'></p>
    <p> ingrese la nacionalidad del residente <input type='text' name='nacionalidad'></p>
    <p><input type='submit' name='enviar' value='enviar'></p>
</form>

<?php if (!empty($resultados)): ?>
    <table>
        <tr>
            <th class="nombre"><?php echo strtoupper($resultados[0]['nombre'] . ' ' . $resultados[0]['apellido']); ?></th>
        </tr>
        <tr>
            <td>Edad: <?php echo $resultados[0]['edad']; ?></td>
        </tr>
        <tr>
            <td>Género: <?php echo $resultados[0]['sexo']; ?></td>
        </tr>
        <tr>
            <td>País de Origen: <?php echo $resultados[0]['pais de origen']; ?></td>
        </tr>
        <tr>
            <td>Estado Civil: <?php echo $resultados[0]['estado civil']; ?></td>
        </tr>
        <tr>
            <td>Hijos: <?php echo $resultados[0]['cantidad de hijos']; ?></td>
        </tr>
        <tr>
            <td>Profesión: <?php echo $resultados[0]['ocupacion']; ?></td>
        </tr>
        <tr>
            <td>Ciudad: <?php echo $resultados[0]['ciudad']; ?></td>
        </tr>
        <tr>
            <td>Vivienda: <?php echo $resultados[0]['tipo de vivienda']; ?></td>
        </tr>
    </table>
<?php else: ?>
    <p>No se encontraron resultados.</p>
<?php endif; ?>
</body>
</html>
