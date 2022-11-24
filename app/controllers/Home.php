<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->usuario = $this->model('usuario');
    }

    public function index()
    {
        if (isset($_SESSION['logueado'])) {

            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
            $datosPublicaciones = $this->usuario->getPublicaciones();

            $verificarLike = $this->usuario->misLikes($_SESSION['logueado']);

            $comentarios = $this->usuario->getComentarios();

            $informacionComentarios = $this->usuario->getInformacionComentarios($comentarios);

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil,
                    'publicaciones' =>  $datosPublicaciones,
                    'misLikes' => $verificarLike,
                    'comentarios' => $informacionComentarios
                ];

                $this->view('pages/home', $datosRed);
            } else {
                $this->view('pages/perfil/completarPerfil', $_SESSION['logueado']);
            }
        } else {
            redirection('/home/login');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosLogin = [
                'usuario' => trim($_POST['usuario']),
                'contrasena' => trim($_POST['contrasena'])
            ];

            $datosUsuario = $this->usuario->getUsuario($datosLogin['usuario']);

            if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin['contrasena'])) {
                $_SESSION['logueado'] = $datosUsuario->idusuario;
                $_SESSION['usuario'] = $datosUsuario->usuario;
                redirection('/home');
            } else {
                $_SESSION['errorLogin'] = 'El usuario o la contraseña son incorrectos';
                redirection('/home');
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/home');
            } else {
                $this->view('pages/login-register/login');
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosRegistro = [
                'privilegio' => '2',
                'email' => trim($_POST['email']),
                'usuario' => trim($_POST['usuario']),
                'contrasena' => password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT)
            ];

            if ($this->usuario->verificarUsuario($datosRegistro)) {
                if ($this->usuario->register($datosRegistro)) {
                    $_SESSION['loginComplete'] = 'Se ha registrado correctamente, ahora puedes ingresar';
                    redirection('/home');
                } else {
                }
            } else {
                $_SESSION['usuarioError'] = 'El usuario no esta disponible, intenta con otro usuario';
                $this->view('pages/login-register/register');
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/home');
            } else {
                $this->view('pages/login-register/register');
            }
        }
    }

    public function insertarRegistrosPerfil()
    {
        $carpeta = 'C:/xampp/htdocs/UDG-friends/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = '/img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'], $ruta);

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'nombre' => trim($_POST['nombre']),
            'ruta' => $rutaImagen
        ];

        if ($this->usuario->insertarPerfil($datos)) {
            redirection('/home');
        } else {
            echo 'El perfil no se ha guardado';
        }
    }

    public function logout()
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        redirection('/home');
    }

    //funciones para el perfil

    public function perfil($user)
    {

        if (isset($_SESSION['logueado'])) {

            $datosPerfil =  $this->usuario->getPerfil($user);

            $datos = [
                'perfil' => $datosPerfil
            ];

            $this->view('pages/perfil/perfil', $datos);
        }
    }

    public function cambiarImagen()
    {
        $carpeta = 'C:/xampp/htdocs/UDG-friends/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = '/img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'], $ruta);

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'ruta' => $rutaImagen
        ];

        $imagenActual = $this->usuario->getPerfil($datos['idusuarios']);

        unlink('C:/xampp/htdocs/UDG-friends/public/' . $imagenActual->fotoPerfil);

        if ($this->usuario->editarFoto($datos)) {
            redirection('/home/perfil/perfil');
        } else {
            echo 'El perfil no se ha guardado';
        }
    }

    public function publicar($idUsuario)
    {

        if (isset($_FILES['imagen'])) {
            $carpeta = 'C:/xampp/htdocs/UDG-friends/public/img/imagenesPublicaciones/';
            opendir($carpeta);
            $rutaImagen = '/img/imagenesPublicaciones/' . $_FILES['imagen']['name'];
            $ruta = $carpeta . $_FILES['imagen']['name'];
            if ($ruta == $carpeta) {
                $rutaImagen = 'Sin imagen';
            } else {
                copy($_FILES['imagen']['tmp_name'], $ruta);
            }
        }

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'contenido' => trim($_POST['contenido']),
            'ruta' => $rutaImagen
        ];

        if ($this->usuario->publicar($datos)) {
            redirection('/home');
        } else {
            echo 'Ya fallo';
        }
    }

    public function eliminar($idpublicacion)
    {

        $publicacion = $this->usuario->getpublicacion($idpublicacion);

        if ($this->usuario->eliminarPublicacion($publicacion)) {
            unlink('C:/xampp/htdocs/UDG-friends/public/' . $publicacion->fotoPublicacion);
            redirection('/home');
        } else {
        }
    }

    public function megusta($idpublicacion, $idpusuario)
    {
        $datos = [
            'idpublicacion' => $idpublicacion,
            'idusuario' => $idpusuario
        ];

        $datosPublicacion = $this->usuario->getPublicacion($idpublicacion);

        if ($this->usuario->rowLikes($datos)) {
            $this->usuario->eliminarLike($datos);
                $this->usuario->deleteLikeCount($datosPublicacion);
                redirection('/home');
        } else {
            if ($this->usuario->agregarLike($datos)) {
                $this->usuario->addLikeCount($datosPublicacion);
            }
            redirection('/home');
        }
    }



    public function comentar()
    {

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $datos = [
                'iduser' => trim($_POST['iduser']),
                'idpublicacion' => trim($_POST['idpublicacion']),
                'comentario' =>  trim($_POST['comentario']),
            ];

            if ($this->usuario->publicarComentario($datos)) {
                redirection('/home');
            } else {
                redirection('/home');
            }

        }else{
            redirection('/home');
        }

       
    }

    public function eliminarComentario($id)
    {

        $this->usuario->eliminarComentarioUsuario($id);
            redirection('/home');
       
    }
}
