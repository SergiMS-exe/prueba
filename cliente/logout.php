<?php 
session_start();

unset($_SESSION['login']);
unset($_SESSION['admin']);
unset($_SESSION['usuario']);
unset($_SESSION['google_login']);
unset($_SESSION['viajes_encontrados']);

header('Location: /index.php');