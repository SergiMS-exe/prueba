<?php include 'paypal/config.php'?>

<section class="container">
    <h1>Mensajeria</h1>

    <?php 
        if (isset($_SESSION['login'])){ 
            ?> 
    <form action="../mensajeria/lista_conversaciones.php" method="GET">
        <input type="hidden" value="<?php echo $_SESSION["usuario"]->_id?>" name="id">
        <th><input type="submit" value="Lista de Conversaciones"></th>
    </form>
    <?php } ?>
</section>