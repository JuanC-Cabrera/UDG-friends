<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">UDG-friends
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
                <li class="nav-item">
                    <form class="d-flex">
                        <input class="form-control me-2" name="buscar" type="text" placeholder="Buscar">
                        <button class="btn btn-outline-success" type="submit">Buscar
                        </button>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Mensajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notificaciones</a>
                </li>
                <li style="margin-right:100px" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="http://localhost/UDG-friends/public/img/usuario.png" />
                        <?php echo ucwords($_SESSION['usuario']); ?>
                    </a>
                    <div class="dropdown-menu" style="margin-right:30px">
                       
                        <a class="dropdown-item" href="<?php echo URL_PROJECT ?>/home/logout">Salir</a>

                    </div>
                </li>


            </ul>
        </div>
    </div>
</nav>