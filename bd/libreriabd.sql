-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2022 a las 03:31:47
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreriabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `Id_autor` int(11) NOT NULL,
  `Nombre_aut` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`Id_autor`, `Nombre_aut`, `Apellidos`) VALUES
(1, 'William', 'Shakespeare'),
(2, 'Gabriel', 'García Márquez'),
(4, 'Paulo', 'Coelho'),
(5, 'Miguel', 'De Cervantes'),
(6, 'Alexandre', 'Dumas'),
(7, 'Alanna', 'Ignacio'),
(8, 'Manuel Miranda', 'Jimenez'),
(9, 'Madeleine', 'Roux'),
(10, 'Oscar', 'Wilde'),
(11, 'J. K.', 'Rowling');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_categoria` int(11) NOT NULL,
  `Nombre_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_categoria`, `Nombre_cat`) VALUES
(1, 'Terror'),
(3, 'Aventura'),
(4, 'Historia'),
(5, 'Misterio'),
(6, 'Accion'),
(7, 'Ficción'),
(8, 'Comics'),
(9, 'Novela'),
(10, 'Cuentos'),
(11, 'Biografías '),
(12, 'Monografías '),
(13, 'Poéticos '),
(14, 'Romance'),
(15, 'Paranormal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `IdLibro` int(11) NOT NULL,
  `NombreLib` varchar(50) NOT NULL,
  `LibroArch` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `Edicion` varchar(10) NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`IdLibro`, `NombreLib`, `LibroArch`, `imagen`, `Edicion`, `Categoria`, `Autor`) VALUES
(1, 'Las montañas', 'archivos/libros/Presentaciones SDA.pdf', 'archivos/img/monta.jpg', '2009', 1, 1),
(2, 'Las aventuras de maverick', 'archivos/libros/Presentaciones SDA.pdf', 'archivos/img/adventures234.jpg', '2022', 1, 1),
(15, 'El Conde Monte Cristo-Alejandro dumas', 'archivos/libros/El conde de Montecristo - Alejandro Dumas.pdf', 'archivos/img/imagen_2022-03-23_132518.png', '1844', 9, 6),
(19, 'Todo Lo Que Soné', 'archivos/libros/Todo lo que soñé - Alanna Ignacio.pdf', 'archivos/img/imagen_2022-03-23_133551.png', '1999', 14, 8),
(20, 'Los Artistas De Huesos', 'archivos/libros/Asylum 2.5, Los artistas de huesos - Madeleine Roux.pdf', 'archivos/img/imagen_2022-03-23_134243.png', '2016', 15, 9),
(21, 'CATACOMB', 'archivos/libros/Asylum 3, Catacomb - Madeleine Roux.pdf', 'archivos/img/imagen_2022-03-23_134655.png', '2016', 1, 9),
(23, 'El Retrato De Dorian Gray', 'archivos/libros/El Retrato de Dorian Gray - Oscar Wilde.pdf', 'archivos/img/imagen_2022-03-23_135807.png', '1890', 9, 10),
(24, 'Escape Del Asylum', 'archivos/libros/Escape del Asylum - Madeleine Roux.pdf', 'archivos/img/imagen_2022-03-25_170953.png', '2015', 1, 9),
(25, 'Harry Potter Y La Cámara Secreta.', 'archivos/libros/J.K. Rowling - Harry Potter y la Cámara secreta-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_190516.png', '1998', 5, 11),
(26, 'Harry Potter Y La Piedra Filosofal', 'archivos/libros/J.K. Rowling - Harry Potter y la Piedra filosofal-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_190716.png', '1998', 5, 11),
(27, 'Harry Potter Y La Orden Del Fenix.', 'archivos/libros/J.K. Rowling - Harry Potter y-la-orden-del-fenix-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_190952.png', '1998', 7, 11),
(28, 'Harry Potter Y El Pricionero De Azkaban.', 'archivos/libros/J.K. Rowling - Harry Potter y el Prisionero de Azkaban-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_191137.png', '1998', 7, 11),
(29, 'Harry Potter Y El Cáliz De Fuego.', 'archivos/libros/J.K. Rowling - Harry Potter y el Cáliz de fuego-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_191329.png', '1998', 7, 11),
(30, 'Harry Potter Y Las Reliquias De La Muerte.', 'archivos/libros/J.K. Rowling  - Harry Potter y las reliquias de la muerte-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_191628.png', '1998', 6, 11),
(31, 'Harry Potter Y El Príncipe Mestizo.', 'archivos/libros/J.K. Rowling  - Harry Potter y el Principe Mestizo-FREELIBROS.ORG.pdf', 'archivos/img/imagen_2022-03-28_192041.png', '1998', 5, 11),
(32, 'Un Beso Bajo La LLuvia.', 'archivos/libros/Un_beso_bajo_la_lluvia_Violeta_Boyd.pdf', 'archivos/img/imagen_2022-03-28_192221.png', '1899', 14, 2),
(33, 'JUICIO FINAL', 'archivos/libros/Juicio Final - John Katzenbach.pdf', 'archivos/img/imagen_2022-03-28_200954.png', '1987', 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `Id_rese` int(11) NOT NULL,
  `Libro` int(11) NOT NULL,
  `Autor` int(11) NOT NULL,
  `Calificacion` float NOT NULL,
  `Opinion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`Id_rese`, `Libro`, `Autor`, `Calificacion`, `Opinion`) VALUES
(1, 1, 1, 8.7, 'esta bien nomas que aburrido'),
(2, 1, 1, 3, 'Me gusto mucho este libro'),
(3, 2, 1, 9, 'muy bueno'),
(4, 33, 5, 1, 'libro culero.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `Nombre_usu` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `Nombre_usu`, `Apellidos`, `Correo`, `Pass`, `Privilegio`) VALUES
(2, 'Andres', 'Valerio Martinez', 'Andru12@gmail.com', '123', 1),
(13, 'Mauricio', 'Rosales', 'mauriciorosales@gmail.com', 'ABCabc123*', 0),
(14, 'Ana', 'lopez', 'ana@gmail.com', 'analopez', 0),
(15, 'ANDRES ', 'Valerio MTZ', 'valentino12mtz@gmail.com', 'PULPOLILA', 0),
(16, 'profe', 'apellido', 'profe@gmail.com', '123456', 0),
(17, 'MARCELINO', 'VENEGAS', 'marcelinovenegas5197@gmail.com', 'Lechuga_sexy', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`Id_autor`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_categoria`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`IdLibro`),
  ADD KEY `Categoria` (`Categoria`),
  ADD KEY `Autor` (`Autor`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`Id_rese`),
  ADD KEY `Libro` (`Libro`),
  ADD KEY `Autor` (`Autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `Id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `IdLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `Id_rese` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `autores` (`Id_autor`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`Id_categoria`);

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`Libro`) REFERENCES `libros` (`IdLibro`),
  ADD CONSTRAINT `reseñas_ibfk_2` FOREIGN KEY (`Autor`) REFERENCES `autores` (`Id_autor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
