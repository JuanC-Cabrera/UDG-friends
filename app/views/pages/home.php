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
                <a href="<?php echo URL_PROJECT ?>/<?php echo $datos['usuario']->usuario ?>/perfil/"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /> </a>
            </div>
            <a style="text-decoration:none; color: #000" href="<?php echo URL_PROJECT ?>/<?php echo $datos['usuario']->usuario ?>/perfil/">
                <div style="margin:auto; margin-top:5px; font-size:x-large;text-align: center;"><?php echo $datos['perfil']->nombreCompleto ?></div>
            </a>
            <div style="margin:auto; margin-bottom: 20px;" class="row">
                <a style="text-decoration:none; color: #000" class="col" href="#">Publicaciones <br> 0 </a>
                <a style="text-decoration:none; color: #000" class="col" href="#">Reacciones <br> 0 </a>
            </div>

        </div>
    </div>
    <!-- Columna principal-->
    <div class="col-6">
        <div style="margin-bottom:10px;" class="card">

            <div class="">
                <div class="" style="width:50px; height:50px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                    <a href="<?php echo URL_PROJECT ?>/<?php echo ucwords($_SESSION['usuario']); ?>/perfil/"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /></a>
                </div>

                <div style="margin-top:-55px; margin-left:80px; font-size:20px " class="mb-3"> <?php echo $datos['usuario']->usuario ?></div>
            </div>
            <form action="<?php echo URL_PROJECT ?>/home/publicar/<?php echo $datos['usuario']->idusuario ?>" enctype="multipart/form-data" method="POST" class="">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                <div class="form-floating">
                    <textarea style="margin-top:35px; height:100px" name="contenido" class="form-control " placeholder="Que estas pensando?" id="floatingTextarea" required></textarea>
                    <label for="floatingTextarea">Que estas pensando?</label>
                </div>

                <div class="">
                    <div style="margin-top: 20px;" class="file-select" id="src-file1">
                        <input accept="image/png,image/jpeg" type="file" name="imagen" aria-label="Archivo">
                    </div>

                    <button class="btn btn-success">Publicar</button>
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
                        <div style="margin-top:-55px; margin-left:80px; font-size:20px " class="mb-3"><?php echo ucwords($datosPublicacion->usuario) ?>
                            <a href="<?php echo URL_PROJECT ?>/<?php echo $datosPublicacion->idpublicacion ?>/eliminar/" style="float:right; margin-right:20px"> <img src="<?php echo URL_PROJECT . '/public/img/eliminar.png' ?>" alt="borrar" /></a>
                        </div>

                        <span><?php echo $datosPublicacion->fechaPublicacion ?></span>
                    </div>
                    <div class="">
                        <p class=""><?php echo $datosPublicacion->contenidoPublicacion ?></p>
                        <div class="" style="max-width:500px; max-height:500px;  overflow: hidden;  margin:15px; min-width:0px;min-height:0;">
                            <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPublicacion ?>" alt="" class="">
                        </div>
                        <div class="like">
                            <a href="<?php echo URL_PROJECT ?>/<?php echo $datosPublicacion->idpublicacion ?>/megusta/<?php echo  $_SESSION['logueado'] ?>">Like<span><?php echo $datosPublicacion->num_likes ?></span></a>
                        </div>

                        <!--Comentarios-->
                        <div class="">
                            <div class="" style="width:30px; height:30px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                                <a href="<?php echo URL_PROJECT ?>/<?php echo ucwords($_SESSION['usuario']); ?>/perfil/"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /></a>
                            </div>
                            <form action="<?php echo URL_PROJECT ?>/home/comentar">
                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['logueado'] ?>">
                                <input type="hidden" name="idpublicacion" value="<?php echo $datosPublicacion->idpublicacion?>">
                                <div class="form-floating">
                                    <textarea name="comentario" class="form-control " id="floatingTextarea" required></textarea>
                                    <label for="floatingTextarea">comentar</label>
                                </div>
                                <div class="">
                                    <button class="btn btn-success">Publicar</button>
                                </div>
                            </form>

                        </div>


                    </div>


                </div>

            </div>
        <?php endforeach ?>
        <!--Publicaciones-->
        <div>

        </div>


    </div>
    <div class="col">
        <div class="">

        </div>
    </div>
</div>




<?php

include_once URL_APP . '/views/custom/footer.php';

?>