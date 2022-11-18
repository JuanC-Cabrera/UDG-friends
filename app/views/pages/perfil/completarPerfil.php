<?php

include_once URL_APP . '/views/custom/header.php';


?>

<div style="margin-top:50px" class="container">
    <div class="card">
        <div class="card-body">
            <h2>Completa tu perfil</h2>
            <h6>Antes de continuar deberas completar tu perfil</h6>
            <hr>
            <div>
                <form action="<?php echo URL_PROJECT ?>/home/insertarRegistrosPerfil" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required>
                    </div>
                    <div>
                        <div class="input-group mb-3">
                            <label class="form-control" for="imagen">Seleccionar una foto</label>
                            <input accept="image/png,image/jpeg" type="file" class="form-control" id="inputGroupFile01" name="imagen" id="imagen" required>
                        </div>
                    </div>
                        <button class="btn btn-primary">Registrar datos</button>
                        <a style="text-decoration: none; margin-left:20px " class="mb-3" href="<?php echo URL_PROJECT ?>/home/logout">Regresar al login</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>