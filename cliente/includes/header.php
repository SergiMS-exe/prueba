<?php
if (true)
    $__DIR_NAME__ =   'http://exameniwsergiomatecliente.herokuapp.com/';
else $__DIR_NAME__ =  'http://localhost/'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $__DIR_NAME__ . "css/styles.css" ?>">
    <title>BlablacarIW</title>
</head>

<body>
    <nav>
        <div class="container">
            <div class="contenido-header">
                <img src="#" alt="Imagen logo">
                <div class="d-flex justify-content-center py-3">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $__DIR_NAME__ . "index.php" ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <?php if (!isset($_SESSION['usuario']->admin)) { ?>
                                <a class="nav-link" href="<?php echo $__DIR_NAME__ . "perfil_usuario.php" ?>">Mi Perfil</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <a href="../servicios/sofa/crear_sofa.php" class="nav-link">Ofertar alojamiento</a>
                        </li>
                        <?php

                        if (!isset($_SESSION['token'])) {
                            header('Location: /login.php');
                        }

                        if (isset($_SESSION['token']) && isset($_SESSION['admin'])) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $__DIR_NAME__ . "admin/admin.php" ?>" class="nav-link">Panel de administración</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $__DIR_NAME__ . "logout.php" ?>" class="nav-link">Cerrar sesión</a>
                            </li>
                        <?php
                        } else { ?>
                            <li class="nav-item">
                                <a href="<?php echo $__DIR_NAME__ . "logout.php" ?>" class="nav-link">Cerrar sesión</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </div>