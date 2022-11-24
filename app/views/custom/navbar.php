<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URL_PROJECT ?>/home">UDG-friends
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ">
               
                
                
            </ul>
            <ul class="navbar-nav ">
            <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mensajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notificaciones</a>
                </li>
                <li class="nav-item">
                    <div style ="width:30px; height:30px; border-radius:50%; background-color: #ccc;  overflow: hidden;  margin:5px;">
                    <img  style="width:100%; max-width: 150%;height:auto;" src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="perfil" />
                </div>
                </li>
               
                <li style="margin-right:100px" class="nav-item dropdown">
                
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       
                           
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