<?php

use Dompdf\Dompdf;

require '../Tarea practica-DOMPDF/dompdf/dompdf/autoload.inc.php';
include 'conf.php';

$archivo='DWS'.date('Ymd_His').'pdf';
$sql = 'SELECT id, nombre, telefono, direccion from tbl_datos';
$resultado = mysqli_query($conexion, $sql);


$html = '<table border="1" cellspacing="0">}
    <tr>
        <th>id</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Dirección</th>
    </tr>';
while ($row = $resultado->fetch_assoc()){
    $html .= '<tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['Nombre'].'</td>
        <td>'.$row['Telefono'].'</td>
        <td>'.$row['Dirección'].'</td>
    </tr>';
}

$html.= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream($archivo);