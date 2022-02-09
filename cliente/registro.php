<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://exameniwsergiomateapi.herokuapp.com/users';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $original = array(
        "nombre" => trim($_POST['nombre']),
        "apellido" => trim($_POST['apellido']),
        "email" => trim($_POST['email']),
        "password" => trim($_POST['password'])
    );

    $usuario = new stdClass();

    foreach ($original as $key => $value) {
        $usuario->$key = $value;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));

    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = json_decode($output);

    $_SESSION['server_msg'] = $result->data->msg;
    $_SESSION['login'] = true;
    unset($data['password']);
    $_SESSION['usuario'] = $usuario;

    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>BlablacarIW</title>
</head>

<body>
    <div class="login-box">
        <div class="login-card">
            <p class="login-text">Registro</p>
            <form action="registro.php" method="POST">
                <div class="login-inputs">
                    <div class="login-input">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required>
                    </div>
                    <div class="login-input">
                        <label for="apellido">Apellidos</label>
                        <input type="text" name="apellido" required>
                    </div>
                    <div class="login-input">
                        <label for="email">Email</label>
                        <input type="text" name="email" required>
                    </div>
                    <div class="login-input">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" required>
                    </div>
                </div>

                <div class="login-botones">
                    <button type="submit" class="button blue-button">Registrarse</button>
                    <button onclick="window.location.href='./index.php'" class="button red-button">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>