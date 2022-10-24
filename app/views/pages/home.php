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
            <a href="<?php echo URL_PROJECT ?>/home/perfil/<?php echo $datos['usuario']->usuario ?>">  <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /> </a>
            </div>
            <a style="text-decoration:none; color: #000" href="<?php echo URL_PROJECT ?>/home/perfil/<?php echo $datos['usuario']->usuario ?>"><div style="margin:auto; margin-top:5px; font-size:x-large;text-align: center;"><?php echo $datos['perfil']->nombreCompleto ?></div></a>
            <div style="margin:auto; margin-bottom: 20px;" class="row">
                <a style="text-decoration:none; color: #000" class="col" href="#">Publicaciones <br> 0 </a>
                <a style="text-decoration:none; color: #000" class="col" href="#">Reacciones <br> 0 </a>
            </div>

        </div>
    </div>
    <!-- Columna principal-->
    <div  class="col-6 card">
        <div class="">

            <div class="">
                <div class="" style="width:50px; height:50px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:15px">
                    <a href="<?php echo URL_PROJECT ?>/home/perfil/<?php echo ucwords($_SESSION['usuario']); ?>"> <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" /></a>
                </div>

                <div style="margin-top:-55px; margin-left:80px; font-size:20px " class="mb-3"> <?php  echo $datos['usuario']->usuario ?></div>
            </div>
            <form action="" class="">
                <div class="form-floating">
                    <textarea style="margin-top:35px; height:100px" name="post" class="form-control " placeholder="Que estas pensando?" id="floatingTextarea" required></textarea>
                    <label for="floatingTextarea">Que estas pensando?</label>
                </div>

                <div class="">
                        <div style="margin-top: 20px;" class="file-select" id="src-file1">
                            <input type="file" name="imagen" aria-label="Archivo">
                        </div>
                       
                    <button class="btn btn-success">Publicar</button>
                </div>
            </form>
        </div>
        <div class="">
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