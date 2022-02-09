<?php 
session_start();

unset($_SESSION['token']);
unset($_SESSION['admin']);
unset($_SESSION['usuario']);
unset($_SESSION['viajes_encontrados']);

header('Location: /index.php');