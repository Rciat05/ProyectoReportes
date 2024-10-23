<?php

use Dompdf\Dompdf;

require '../ProyectoReportes/dompdf/dompdf/autoload.inc.php';
include 'conf.php';

$archivo='DWS'.date('Ymd_His').'pdf';
// $sql = 'SELECT id, nombre, telefono, direccion from tbl_datos';
// $resultado = mysqli_query($conexion, $sql);


// $html = '<table border="1" cellspacing="0">
//     <tr>
//         <th>id</th>
//         <th>Nombre</th>
//         <th>Telefono</th>
//         <th>Dirección</th>
//     </tr>';
// while ($row = $resultado->fetch_assoc()){
//     $html .= '<tr>
//         <td>'.$row['id'].'</td>
//         <td>'.$row['nombre'].'</td>
//         <td>'.$row['telefono'].'</td>
//         <td>'.$row['direccin'].'</td>
//     </tr>';
// }

// $html.= '</table>';



$sql = 'SELECT producto, proveedor, existencias, precio from tbl_invesproduct ';
     $resultado = mysqli_query($conexion, $sql);


$html = '<table border="1" cellspacing="0">
    <tr>
        <th>Producto</th>
        <th>Proveedor</th>
        <th>Existencias</th>
        <th>Precio</th>
    </tr>';
while ($row = $resultado->fetch_assoc()){
    $html .= '<tr>
        <td>'.$row['producto'].'</td>
        <td>'.$row['proveedor'].'</td>
        <td>'.$row['existencias'].'</td>
        <td>'.$row['precio'].'</td>
    </tr>';
}

$html.= '</table>';



$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream($archivo);
