<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';


?>

<div style=" width: 80%; margin:auto; margin-top:20px" class="row">
    <div class="col">
        <!-- Columna de perfil-->
        <div style="justify-content: center" class="card">
            <div class="card-img-top carta-arriba"></div>
            <div class="foto-columna">
                <a href="<?php echo URL_PROJECT ?>/<?php echo ucwords($_SESSION['logueado']) ?>/perfil/"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /> </a>
            </div>
            <a style="text-decoration:none; color: #000" href="<?php echo URL_PROJECT ?>/<?php echo $datos['usuario']->usuario ?>/perfil/">
                <div style="margin:auto; margin-top:5px; font-size:x-large;text-align: center;"><?php echo $datos['perfil']->nombreCompleto ?></div>
            </a>
            <div style="margin:auto; margin-bottom: 20px;" class="row">

            </div>

        </div>
    </div>
    <!-- Columna principal-->
    <div class="col-6">
        <div style="margin-bottom:10px;" class="card">

            <div class="">
                <div class="" style="width:50px; height:50px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                    <a href="<?php echo URL_PROJECT ?>/<?php echo ucwords($_SESSION['logueado']) ?>/perfil/"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /></a>
                </div>

                <div style="margin-top:-55px; margin-left:80px; font-size:20px " class="mb-3"> <?php echo $datos['usuario']->usuario ?></div>
            </div>
            <form action="<?php echo URL_PROJECT ?>/home/publicar/<?php echo $datos['usuario']->idusuario ?>" enctype="multipart/form-data" method="POST" class="">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                <div class="form-floating">
                    <textarea style="height:40px;margin-top:35px;margin-left:10px; height:80px; width:490px" name="contenido" class="form-control " placeholder="Que estas pensando?" id="floatingTextarea" required></textarea>
                    <label for="floatingTextarea">Que estas pensando?</label>
                </div>

                <div class="">
                    <div style="margin:10px" class="file-select" id="src-file1">
                        <input accept="image/png,image/jpeg" type="file" name="imagen" aria-label="Archivo">
                    </div>

                    <button style="margin:10px" class="btn btn-success">Publicar</button>
                </div>
            </form>
        </div>

        <div>

        </div>

        <!--Publicaciones-->
        <?php foreach ($datos['publicaciones'] as $datosPublicacion) : ?>
            <div style="margin-bottom:10px;" class="card">

                <div class="">
                    <div>

                        <div class="" style="width:50px; height:50px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                            <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPerfil ?>" alt="perfil" />

                        </div>

                        <a style="text-decoration:none; color:#000" href="<?php echo URL_PROJECT ?>/<?php echo ucwords($datosPublicacion->idUserPublico); ?>/perfil/">
                            <div style="margin-top:-65px; margin-left:80px; font-size:20px " class="mb-3"><?php echo ucwords($datosPublicacion->usuario) ?>
                        </a>

                        <?php if ($datosPublicacion->idUserPublico == $_SESSION['logueado'] || $_SESSION['logueado'] == 1) : ?>
                            <a href="<?php echo URL_PROJECT ?>/<?php echo $datosPublicacion->idpublicacion ?>/eliminar/" style="float:right; margin-right:20px"> <img src="<?php echo URL_PROJECT . '/public/img/eliminar.png' ?>" alt="borrar" /></a>
                        <?php endif ?>

                    </div>
                    <span style="position:absolute;margin-top:-15px; margin-left:80px; font-size:10px "><?php echo $datosPublicacion->fechaPublicacion ?></span>


                    <div class="">
                        <p style="margin-left:20px;margin:20px" class=""><?php echo $datosPublicacion->contenidoPublicacion ?></p>
                        <?php if ($datosPublicacion->fotoPublicacion != 'Sin imagen') : ?>
                            <div class="" style=" width:auto;max-width:500px; max-height:500px;  overflow: hidden;  margin:15px; min-width:0px;min-height:0;">
                                <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPublicacion ?>" alt="" class="">
                            </div>
                        <?php endif ?>
                        <div style="justify-content:right" class="like">
                            <a style="margin-right:20px; text-decoration:none; color:#000" href="<?php echo URL_PROJECT ?>/<?php echo $datosPublicacion->idpublicacion ?>/megusta/<?php echo  $_SESSION['logueado'] ?>">Like <?php echo $datosPublicacion->num_likes ?></a>
                        </div>

                        <!--Comentarios-->
                        <div style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;">
                            <div>
                                <div class="" style="width:40px; height:40px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                                    <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" />
                                    < </div>
                                        <form action="<?php echo URL_PROJECT ?>/home/comentar" method="POST">
                                            <input type="hidden" name="iduser" value="<?php echo $_SESSION['logueado'] ?>">
                                            <input type="hidden" name="idpublicacion" value="<?php echo $datosPublicacion->idpublicacion ?>">
                                            <div class="form-floating">
                                                <textarea style="height:40px;margin-top:-60px;margin-left:70px; height:60px; width:320px" name="comentario" class="form-control " placeholder="Que estas pensando?" id="floatingTextarea" required></textarea>
                                                <label style="margin-left:70px;" for="floatingTextarea">comentar</label>
                                            </div>
                                            <div class="">
                                                <button style="margin: 5px;margin-left:410px;" class="btn btn-success">Publicar</button>
                                            </div>
                                        </form>
                                </div>
                            </div>

                            <?php foreach ($datos['comentarios'] as $datosComentarios) : ?>
                                <?php if ($datosComentarios->idPublicacion == $datosPublicacion->idpublicacion) : ?>
                                    <div style="margin-left:50px">

                                        <div class="" style="margin-left:30px; width:30px; height:30px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                                            <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datosComentarios->fotoPerfil ?>" alt="perfil" />

                                        </div>

                                        <a style="color:#000;text-decoration:none" href="<?php echo URL_PROJECT ?>/<?php echo ucwords($datosComentarios->idUser); ?>/perfil/">
                                            <div style="margin-top:-40px; margin-left:60px; font-size:13px " class="mb-3"><?php echo ucwords($datosComentarios->usuario) ?>
                                        </a>
                                        <?php if ($datosComentarios->idUser == $_SESSION['logueado'] || $_SESSION['logueado'] == 1) : ?>
                                            <a href="<?php echo URL_PROJECT ?>/<?php echo $datosComentarios->idcomentario ?>/eliminarComentario/" style="float:right; margin-right:20px"> <img src="<?php echo URL_PROJECT . '/public/img/eliminar.png' ?>" alt="borrar" /></a>
                                        <?php endif ?>
                                    </div>

                                    <p style="margin-left:60px;font-size:15px; margin-top:-17px" class=""><?php echo $datosComentarios->contenidoComentario ?></p>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>

                    </div>

                </div>
            </div>

    </div>
<?php endforeach ?>


</div>
<div class="col">
    <div class="">

    </div>
</div>
</div>




<?php

include_once URL_APP . '/views/custom/footer.php';

?>