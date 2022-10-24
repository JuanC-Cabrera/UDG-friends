<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

?>

<div class="" style="width:100%; height:300px; background-color: #ccc;  overflow: hidden;">
    <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" />
</div>

<div style=" width: 80%; margin:auto; margin-top:20px" class="row">
    <div class="col-4">
        <!-- Columna de perfil-->
        <div style="justify-content: center" class="card">
            <div></div>
            <div class="foto-perfil">
                <img style="width: 100%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" />
            </div>
           
            <form  action="<?php echo URL_PROJECT ?>/home/cambiarImagen" method="POST" enctype="multipart/form-data">
                <div style="margin:auto">
                    <div class="file-select" id="src-file1">
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado']?>">
                        <input type="file" name="imagen">
                    </div>

                    <button class="btn btn-success">Cambiar foto</button>
                </div>
            </form>
        
            <div style="margin:auto; margin-top:5px; font-size:x-large;text-align: center;"><?php echo $datos['perfil']->nombreCompleto ?></div>
            <div style="margin:auto; margin-bottom: 20px;" class="row">
                <a style="text-decoration:none; color: #000" class="col" href="#">Publicaciones <br> 0 </a>
                <a style="text-decoration:none; color: #000" class="col" href="#">Reacciones <br> 0 </a>
            </div>

        </div>
    </div>
    <!-- Columna principal-->
    <div class="col-6 card">
        <div class="">

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