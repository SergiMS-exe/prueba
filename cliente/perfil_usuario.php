<?php
session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['token'])) {
    $res = file_get_contents("http://exameniwsergiomateapi.herokuapp.com/couches");
    $sofas = json_decode($res)->data->sofas;

    include "./includes/header.php";
} else {
    header('Location: /login.php');
}
?>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>BlablacarIW - Mi cuenta</title>
</head>

<!--- Datos usuario --->
<h2 style="margin-top:40px; margin-left:10px">Mis datos</h2>
<p style="margin-left:20px">Nombre: <?php echo $user['nombre'] . " " . $user['apellido']; ?>
<p>
<p style="margin-left:20px">Email: <?php echo $user['email']; ?>
<p>

    <!--- TODO: Foto de perfil --->


<h3 style="margin-top:40px; margin-left:10px">Mis sofas</h3>
<table>
        <tr>
            <th>Propietario</th>
            <th>Direccion</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Disponible Desde</th>
        </tr>
        <?php
        foreach ($sofas as $sofa) {
            
        ?>
            <tr>
                <td><?php echo $sofa->email_propietario; ?></td>
                <td><?php echo $sofa->direccion; ?></td>
                <td><?php echo $sofa->latitud; ?></td>
                <td><?php echo $sofa->longitud; ?></td>
                <td><?php echo gmdate("d-m-Y", $sofa->fecha_inicio_disponible); ?></td>
                <form action="servicios/sofa/detalles_sofa.php" method="GET">
                    <input type="hidden" value="<?php echo $sofa->_id ?>" name="id">
                    <td><input type="submit" value="Detalles"></td>
                </form>
            </tr>
        <?php }?>


