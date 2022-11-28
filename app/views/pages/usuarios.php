<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

?>

<div class="container">
  <div class="row align-items-start">
    <h3  style="position:relative;margin-top:50px;left:35px" class="col">
    Foto
</h3>
    <h3  style="position:relative;right:65px;margin-top:50px"class="col">
    Id del Usuario
</h3>
    <h3  style="margin-top:50px"class="col">
    Nombre Completo
</h3>
    <h3  style="margin-top:50px"class="col">
    Nombre de usuario
</h3>
    <h3  style="margin-top:30px"class="col">
    
</h3>
  </div>
    </div>

<?php foreach ($datos['allUsuarios'] as  $usuariosRegistrados) : ?>
    <div style="margin-top:10px;margin-bottom:10px"class="container card">
  <div class="row align-items-start">
    <div class="col">
    <div class="" style="width:100px; height:100px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $usuariosRegistrados->fotoPerfil ?>" alt="perfil" />
            </div>
    </div>
    <div  style="margin-top:50px"class="col">
    <span><?php echo  $usuariosRegistrados->idusuario ?></span>
    </div>
    <div  style="margin-top:50px"class="col">
    <span><?php echo  $usuariosRegistrados->nombreCompleto ?></span>
    </div>
    <div  style="margin-top:50px"class="col">
    <span><?php echo  $usuariosRegistrados->usuario ?></span>
    </div>
    <div  style="margin-top:30px"class="col">
    <a href="<?php echo URL_PROJECT ?>/<?php echo $usuariosRegistrados->idusuario ?>/eliminarUsuarios/"> <img  src="<?php echo URL_PROJECT . '/public/img/eliminar2.png' ?>" alt="borrar" /></a>
    </div>
  </div>
    </div>
<?php endforeach ?>
