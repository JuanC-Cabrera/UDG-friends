<?php

include_once URL_APP . '/views/custom/header.php';

?>



<div style="margin-top:50px" class="container">
    <div style="margin-bottom:50px" class="container">
        <h1 style="color:#052e6c; text-align: center; margin-top:40px; font-weight: bold; "><b>UDG Friends</b></h1>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Registrarme</h2>
                <form action="<?php echo URL_PROJECT ?>/home/register" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Correo:</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingresa tu email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Ingresa un nombre de usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="contrasena" placeholder="Ingresa una contraseña" required>
                    </div>

                    <div class="mb-3">
                        <input style="margin-right:80px" type="submit" class="btn btn-success" id="submit" value="Registrarme">


                        ¿Ya tienes una cuenta?
                        <a href="<?php echo URL_PROJECT ?>/home/login">Ingresar</a>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['usuarioError'])) : ?>
    <div style="margin-top:5px" class="alert alert-warning alert-dismissible fade show container" role="alert">
        <?php echo $_SESSION['usuarioError'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


<?php unset($_SESSION['usuarioError']);
endif ?>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>