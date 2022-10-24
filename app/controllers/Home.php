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

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil
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

    public function perfil()
    {

        if (isset($_SESSION['logueado'])) {

            $perfil = $_SESSION['usuario'];

            $datos = [
                'perfil' => $this->usuario->getPerfil($_SESSION['logueado'])
            ];

            $this->view('pages/perfil/perfil', $datos, $perfil);
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

        if ($this->usuario->editarFoto($datos)) {
            redirection('/home/perfil/perfil');
        } else {
            echo 'El perfil no se ha guardado';
        }
    }
}
