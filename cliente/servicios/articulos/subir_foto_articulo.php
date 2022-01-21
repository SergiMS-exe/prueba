<?php
    
?>

<div class="box">
    <form enctype="multipart/form-data" action="../funciones/enviar_imagen.php" method="POST">
        <h3>Subir imagen</h3>
        <input type="file" name="imagen" type="image/jpeg, image/jpg, image/png">
        <input value="<?php echo $data->data->usuario[0]->_id?>" id="id" name="id" type="hidden">
        <input type="submit" value="Enviar">
    </form>
</div>