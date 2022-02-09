<?php
session_start();
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents("https://exameniwsergiomateapi.herokuapp.com/users?email=" . $_POST['email']);
    $user = json_decode($data);

    if (!empty($user->data->usuarios)) {
        //TO-DO: Comprobacion del password
        if ($user->data->usuarios[0]->password === $_POST['password']) {
            unset($user->data->usuarios[0]->password);
            $_SESSION['usuario'] = $user->data->usuarios[0];

            $_SESSION['login'] = true;

            if ($_POST['email'] === 'pruebaparaingweb@gmail.com') {
                $_SESSION['admin'] = true;
            }

            header('Location: ./index.php');
        } else {
            echo "El usuario no existe";
        }
    } else {
        echo "El usuario no existe";
    }
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
            <p class="login-text">Inicio de sesión</p>
            <!-- <form action="login.php" method="POST">
                <div class="login-inputs">
                    <div class="login-input">
                        <label for="email">Email</label>
                        <input type="text" name="email">
                    </div>
                    <div class="login-input">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                    </div>
                </div>

                <div class="login-botones">
                    <button type="submit" class="button blue-button">Iniciar sesión</button>
                    <button onclick="window.location.href='./servicios/google/login.php'" class="button red-button">Google</a>
                </div>
            </form>
            <a href="./registro.php">Registrarse</a> -->
            <div class="login-botones">
                <button onclick="window.location.href='./servicios/google/login.php'" class="button red-button">Google</a>
            </div>
        </div>
    </div>
</body>