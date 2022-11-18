-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2022 a las 16:11:07
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `udg-friends`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentario` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `contenidoComentario` longtext NOT NULL,
  `fechaComentario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `idlike` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idmensaje` int(11) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  `usuarioMando` int(11) NOT NULL,
  `contenido` longtext NOT NULL,
  `fechaMensaje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tipoNotificaion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fotoPerfil` varchar(200) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `idUsuario`, `fotoPerfil`, `nombreCompleto`) VALUES
(1, 1, '/img/imagenesPerfil/Admin.jpg', 'Administrador de UDG-friends'),
(2, 2, '/img/imagenesPerfil/Mazapan.jpg', 'Juan Carlos Cabrera Hernández'),
(3, 4, '/img/imagenesPerfil/images.jpg', 'Jesyka Jazmin Barajas'),
(4, 5, '/img/imagenesPerfil/icono_netflix_nuevo.jpg', 'Mike Ruiz'),
(5, 6, '/img/imagenesPerfil/descarga (1).jpg', 'Tets test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `idPerfil` int(11) NOT NULL,
  `nombrePrivilegio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`idPerfil`, `nombrePrivilegio`) VALUES
(1, 'Administrador'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idpublicacion` int(11) NOT NULL,
  `idUserPublico` int(11) NOT NULL,
  `contenidoPublicacion` longtext NOT NULL,
  `fechaPublicacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposnotificaciones`
--

CREATE TABLE `tiposnotificaciones` (
  `idtiposNotificaciones` int(11) NOT NULL,
  `nombreTipo` varchar(60) NOT NULL,
  `mensajeNotificacion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idPrivilegio` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idPrivilegio`, `correo`, `usuario`, `contrasena`, `fecha_registro`) VALUES
(1, 1, 'Administrador@mail.com', 'Super Administrador', '$2y$10$8ThOuJTT106AVKidheFZHO4gA6IXd7BanACgDF4WFCke8x0DeLTFm', '2022-10-23 02:26:29'),
(2, 2, 'juca@gmail.com', 'Juca', '$2y$10$MT2.Csr1KSiKLLDVM3Db3.epOmn/Lw969vfr7M6L720apumRw5sG2', '2022-10-23 03:21:18'),
(3, 2, 'pepe@mail.com', 'pepe', '$2y$10$2GYUuhGSZHy5F/xXjQRRGuPffsYim4kGpbrNdfnbGqNRtghr5QczK', '2022-10-23 03:37:32'),
(4, 2, 'jesykass@mail.com', 'jesykass', '$2y$10$7zfX15mEFopnEL9lWyEic.0gdSEPSL9unMazg2zUnu0/8xOKsbzXC', '2022-10-23 17:01:12'),
(5, 2, 'test@mail.com', 'mike', '$2y$10$ceWA/7.A7lqOb9beLxea4eYNaZ7SD.1JzEoyUnzMZLVzhrPGzF8ye', '2022-10-23 17:07:16'),
(6, 2, 'test@mail.com', 'Test', '$2y$10$BXBrycngc6OAWD4XQcZtKewpTj1zeNZSCAjisFtuQTrbJN2840Kxi', '2022-10-24 13:14:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentario`),
  ADD KEY `comentarioPublicacion_idx` (`idPublicacion`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `publiLikes_idx` (`idPublicacion`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `fk_mensajes_usuarios1_idx` (`usuarios_idusuario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`),
  ADD KEY `usuarioNotificacion_idx` (`idUsuario`),
  ADD KEY `fk_notificaciones_tiposNotificaciones1_idx` (`tipoNotificaion`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`),
  ADD KEY `perfilUser_idx` (`idUsuario`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`idPerfil`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idpublicacion`),
  ADD KEY `publicacioesUser_idx` (`idUserPublico`);

--
-- Indices de la tabla `tiposnotificaciones`
--
ALTER TABLE `tiposnotificaciones`
  ADD PRIMARY KEY (`idtiposNotificaciones`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `priviUser_idx` (`idPrivilegio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `idlike` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idmensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idpublicacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposnotificaciones`
--
ALTER TABLE `tiposnotificaciones`
  MODIFY `idtiposNotificaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarioPublicacion` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `publiLikes` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuarios1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_tiposNotificaciones1` FOREIGN KEY (`tipoNotificaion`) REFERENCES `tiposnotificaciones` (`idtiposNotificaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarioNotificacion` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfilUser` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicacioesUser` FOREIGN KEY (`idUserPublico`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `priviUser` FOREIGN KEY (`idPrivilegio`) REFERENCES `privilegios` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
