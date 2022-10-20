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
                <h2>Iniciar sesion</h2>
                <form action="<?php echo URL_PROJECT ?>/home/login" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Ingresa tu nombre de usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="contrasena" placeholder="Ingresa tu contraseña" required>
                    </div>

                    <div class="mb-3">
                        <input style="margin-right:115px" type="submit" class="btn btn-success" id="submit" value="Ingresar">


                        ¿No tienes una cuenta?
                        <a href="<?php echo URL_PROJECT ?>/home/register">Registrar</a>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Alerta de Usuario o contraseña incorrectos-->
<?php if (isset($_SESSION['errorLogin'])) : ?>
    <div style="margin-top:5px" class="alert alert-danger alert-dismissible fade show container" role="alert">
        <?php echo $_SESSION['errorLogin'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


<?php unset($_SESSION['errorLogin']);
endif ?>

<!-- Alerta de registro completo -->

<?php if (isset($_SESSION['loginComplete'])) : ?>
    <div style="margin-top:5px" class="alert alert-warning alert-dismissible fade show container" role="alert">
        <?php echo $_SESSION['loginComplete'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


<?php unset($_SESSION['loginComplete']);
endif ?>



<?php

include_once URL_APP . '/views/custom/footer.php';

?>