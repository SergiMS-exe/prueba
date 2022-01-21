<?php 

session_start();

$origen = trim($_GET['origen']);
$destino = trim($_GET['destino']);
$fecha = strtotime($_GET['fecha']);
$hora = strtotime($_GET['hora']);

$res = file_get_contents("http://localhost:3000/travels/search?origen=" . $origen . "&destino=" . $destino);
$data = json_decode($res);
$viajes = array();

foreach ($data->viajes as $viaje){
    if ($fecha === $viaje->fecha_salida && $hora > $viaje->hora_salida){
        $viajes[] = $viaje;
    }
}

$_SESSION['viajes_encontrados'] = $viajes;
header('Location: ../../index.php');
?>