-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-11-2024 a las 10:48:10
-- Versión del servidor: 10.5.27-MariaDB
-- Versión de PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `picify_new_final_database`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`picify`@`localhost` PROCEDURE `BORRAR_FOTO` (IN `NEW_DATE` DATE, IN `DESCRIPTION` TEXT, IN `NEW_OWNER` CHAR(64), IN `INTERNAL_ID` INT)   DELETE FROM Fotos WHERE (Fecha = NEW_DATE AND Descripcion = DESCRIPTION AND Owner = NEW_OWNER AND INTERNAL_ID = ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `BORRAR_GALERIA` (IN `INTERNAL_ID` INT, IN `OWNER_ID` INT, IN `GALLERY_NAME` CHAR(64))   DELETE FROM Galerias WHERE (ID = INTERNAL_ID AND ID_Propietario = OWNER_ID AND Nombre = GALLERY_NAME)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `BORRAR_RELACION_EXHIBIDOS` (IN `GALLERY_ID` INT, IN `PICTURE_ID` INT)   DELETE FROM Exhibidos WHERE (GALLERY_ID = ID_Galeria AND PICTURE_ID = ID_Foto)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CAMBIAR_EMAIL` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64), IN `NEW_EMAIL` CHAR(64))   UPDATE Fotografos SET Email = NEW_EMAIL WHERE Nombre = NAME AND Apellido = SURNAME AND Nickname = SEARCH_NICKNAME$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CAMBIAR_NICKNAME` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_EMAIL` CHAR(64), IN `NEW_NICKNAME` CHAR(64))   UPDATE Fotografos SET Nickname = NEW_NICKNAME WHERE Nombre = NAME AND Apellido = SURNAME AND Email = SEARCH_EMAIL$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CAMBIAR_NICKNAME_FOTOS` (IN `OLD_NICKNAME` CHAR(64), IN `NEW_NICKNAME` CHAR(64))   UPDATE Fotos SET Owner = NEW_NICKNAME WHERE Owner = OLD_NICKNAME$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CAMBIAR_TEL` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64), IN `NEW_PHONE` VARCHAR(20))   UPDATE Fotografos SET Telefono = NEW_PHONE WHERE Nombre = NAME AND Apellido = SURNAME AND Nickname = SEARCH_NICKNAME$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CARGAR_IMG_PERFIL` (IN `FILENAME` CHAR(64), IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `NICKNAME` CHAR(64))   UPDATE Fotografos SET IMG_Perfil = FILENAME WHERE NAME = Nombre AND SURNAME = Apellido AND NICKNAME = Nickname$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CHECK_EMAIL` (IN `SEARCH_EMAIL` CHAR(64))   SELECT * FROM Fotografos WHERE (Email = SEARCH_EMAIL)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CHECK_EMAIL_AND_NICKNAME` (IN `SEARCH_EMAIL` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64))   SELECT * FROM Fotografos WHERE (SEARCH_EMAIL = Email OR SEARCH_NICKNAME = Nickname)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `CHECK_NICKNAME` (IN `SEARCH_NICKNAME` CHAR(64))   SELECT * FROM Fotografos WHERE (Nickname = SEARCH_NICKNAME)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_ASC` ()   SELECT * FROM Fotos
ORDER BY Fecha ASC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_ASCconCATEGORY` (IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (ID_Categoria = CATEGORY_ID)
ORDER BY Fecha ASC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_ASCconUSER` (IN `SEARCH_OWNER` CHAR(64))   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER)
ORDER BY Fecha ASC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_ASCconUSERyCATEGORY` (IN `SEARCH_OWNER` CHAR(64), IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER AND ID_Categoria = CATEGORY_ID)
ORDER BY Fecha ASC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_CATEGORY` (IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (ID_Categoria = CATEGORY_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_DES` ()   SELECT * FROM Fotos
ORDER BY Fecha DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_DESconCATEGORY` (IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (ID_Categoria = CATEGORY_ID)
ORDER BY Fecha DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_DESconUSER` (IN `SEARCH_OWNER` CHAR(64))   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER)
ORDER BY Fecha DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_DESconUSERyCATEGORY` (IN `SEARCH_OWNER` CHAR(64), IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER AND ID_Categoria = CATEGORY_ID)
ORDER BY Fecha DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_SUBIDAS_HOY` ()   SELECT COUNT(*) AS Hoy 
FROM Fotos 
WHERE Fecha >= CURDATE()$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_SUBIDAS_MES` ()   SELECT
  COUNT(*),
  SUM(DATE_FORMAT(Fecha, '%Y-%m-01') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m-01'))
FROM
  Fotos$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_UPDATE_CATEGORIA` (IN `NEW_ID` INT, IN `INTERNAL_ID` INT, IN `SEARCH_OWNER` CHAR(64))   UPDATE Fotos SET ID_Categoria = NEW_ID WHERE (INTERNAL_ID = ID AND Owner = SEARCH_OWNER)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_UPDATE_DESC` (IN `NEW_DESC` TEXT, IN `SEARCH_OWNER` CHAR(64), IN `INTERNAL_ID` INT)   UPDATE Fotos SET Descripcion = NEW_DESC WHERE (SEARCH_OWNER = Owner AND INTERNAL_ID = ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_UPDATE_FECHA` (IN `NEW_DATE` DATE, IN `SEARCH_OWNER` CHAR(64), IN `INTERNAL_ID` INT)   UPDATE Fotos SET Fecha = NEW_DATE WHERE (SEARCH_OWNER = Owner AND INTERNAL_ID = ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_USER` (IN `SEARCH_OWNER` CHAR(64))   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `FOTOS_USERyCATEGORY` (IN `SEARCH_OWNER` CHAR(64), IN `CATEGORY_ID` INT)   SELECT * FROM Fotos WHERE (Owner = SEARCH_OWNER AND ID_Categoria = CATEGORY_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_CATEGORIA` (IN `SEARCH_ID_CATEGORIA` INT)   SELECT Nombre from Categorias WHERE (ID = SEARCH_ID_CATEGORIA)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_FOTOGRAFO_CON_ID` (IN `SEARCH_ID` INT)   SELECT * FROM Fotografos WHERE (SEARCH_ID = ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_FOTOGRAFO_CON_OWNER` (IN `OWNER` CHAR(64))   SELECT * FROM Fotografos WHERE Nickname = OWNER$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_FOTOS_DE_UNA_GALERIA` (IN `GALLERY_ID` INT)   SELECT * FROM Exhibidos WHERE (ID_Galeria = GALLERY_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_FOTO_CON_ID` (IN `SEARCH_ID` INT)   SELECT * FROM Fotos WHERE (ID = SEARCH_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_GALERIA` (IN `SEARCH_ID` INT)   SELECT * FROM Galerias WHERE (ID = Search_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_ID` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_EMAIL` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64))   SELECT ID from Fotografos WHERE NAME = Nombre AND SURNAME = Apellido AND SEARCH_EMAIL = Email AND SEARCH_NICKNAME = Nickname$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_IMG_PERFIL` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_EMAIL` CHAR(64), IN `SEARCH_NICKNAME` VARCHAR(64))   SELECT IMG_Perfil FROM Fotografos WHERE Nombre = NAME AND SURNAME = Apellido AND Email = SEARCH_EMAIL AND Nickname = SEARCH_NICKNAME$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_MOST_POPULAR_CATEGORY` ()   SELECT ID_Categoria, COUNT(ID_Categoria) AS CategoriaPopular 
FROM Fotos
GROUP BY ID_Categoria
ORDER BY CategoriaPopular DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_MOST_POPULAR_COUNTRIES` ()   SELECT Country, COUNT(Country) AS CountryPopular 
FROM Fotos
GROUP BY Country
ORDER BY CountryPopular DESC$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_NUMBER_OF_GALLERIES` ()   SELECT COUNT(*) FROM Galerias$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_NUMBER_OF_USERS` ()   SELECT COUNT(*) FROM Fotografos$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `GET_TELEFONO` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_EMAIL` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64))   SELECT Telefono FROM Fotografos WHERE NAME = Nombre AND SURNAME = Apellido AND Email = SEARCH_EMAIL AND SEARCH_NICKNAME = Nickname$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `INSERTAR_CATEGORIA` (IN `NAME` CHAR(64))   INSERT INTO Categorias (Nombre)
VALUES (NAME)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `INSERTAR_FOTO` (IN `NEW_DATE` DATE, IN `DESCRIPTION` TEXT, IN `FILENAME` CHAR(64), IN `NEW_OWNER` CHAR(64), IN `CATEGORY_ID` INT(11), IN `LAT` FLOAT, IN `LON` FLOAT, IN `NEW_COUNTRY` CHAR(64), IN `NEW_OWNER_ID` INT)   INSERT INTO Fotos (Nombre, Owner, Fecha, Descripcion, Latitud, Longitud, ID_Categoria, Country, ID_Propietario)
VALUES (FILENAME, NEW_OWNER, NEW_DATE, DESCRIPTION, LAT, LON, CATEGORY_ID, NEW_COUNTRY, NEW_OWNER_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `INSERTAR_FOTO_EXHIBIR` (IN `GALLERY_ID` INT, IN `PICTURE_ID` INT)   INSERT INTO Exhibidos (ID_Galeria, ID_Foto)
VALUES (GALLERY_ID, PICTURE_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `INSERTAR_GALERIA` (IN `ID_OWNER` INT, IN `NAME` CHAR(64), IN `DESCRIPTION` TEXT, IN `IMAGE` CHAR(64))   INSERT INTO Galerias (ID_Propietario, Nombre, Descripcion, IMG_Portada)
VALUES (ID_OWNER, NAME, DESCRIPTION, IMAGE)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `INTRODUCIR_FOTOGRAFO` (IN `NEW_NAME` CHAR(64), IN `NEW_SURNAME` CHAR(64), IN `NEW_EMAIL` CHAR(64), IN `NEW_PHONE` VARCHAR(20), IN `NEW_NICKNAME` CHAR(64), IN `NEW_BIRTHDATE` DATE)   INSERT INTO Fotografos (Nombre, Apellido, Email, Telefono, Nickname, Fecha_Nacimiento)
VALUES (NEW_NAME, NEW_SURNAME, NEW_EMAIL, NEW_PHONE, NEW_NICKNAME, NEW_BIRTHDATE)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `LISTAR_FOTOS` ()   SELECT * FROM Fotos$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `LISTAR_FOTOS_OWNER` (IN `SEARCH_OWNER` CHAR(64))   SELECT * FROM Fotos WHERE (SEARCH_OWNER = Owner)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `LISTAR_GALERIAS` ()   SELECT * FROM Galerias$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `LISTAR_GALERIAS_CON_ID` (IN `SEARCH_ID` INT)   SELECT * FROM Galerias WHERE (ID_Propietario = SEARCH_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `SEARCH_FOR_CATEGORIA` (IN `NAME_TO_SEARCH` CHAR(64))   SELECT * FROM Categorias WHERE (Nombre = NAME_TO_SEARCH)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `SEARCH_FOR_CATEGORIA_ID` (IN `CATEGORY_ID` INT)   SELECT * FROM Categorias WHERE (CATEGORY_ID = ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `SEARCH_FOR_CUENTA` (IN `NAME` CHAR(64), IN `SURNAME` CHAR(64), IN `SEARCH_EMAIL` CHAR(64), IN `SEARCH_NICKNAME` CHAR(64))   SELECT * from Fotografos WHERE (NAME = Nombre AND SURNAME = Apellido AND SEARCH_EMAIL = Email AND SEARCH_NICKNAME = Nickname)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `SEARCH_GALERIA` (IN `GALLERY_NAME` CHAR(64), IN `OWNER_ID` INT)   SELECT * FROM Galerias WHERE (Nombre = GALLERY_NAME AND ID_Propietario = OWNER_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `SEARCH_GALERIA_NAME` (IN `GALLERY_NAME` CHAR(64))   SELECT * FROM Galerias WHERE (Nombre = GALLERY_NAME)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `TOTAL_FOTOS` ()   SELECT COUNT(ID) AS NumeroFotos FROM Fotos$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `UPDATE_GALERIA_DESC` (IN `NEW_DESC` TEXT, IN `OWNER_ID` INT, IN `GALLERY_ID` INT)   UPDATE Galerias SET Descripcion = NEW_DESC WHERE (ID_Propietario = OWNER_ID AND ID = GALLERY_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `UPDATE_GALERIA_IMG` (IN `NEW_FILENAME` CHAR(64), IN `OWNER_ID` INT, IN `GALLERY_ID` INT)   UPDATE Galerias SET IMG_Portada = NEW_FILENAME WHERE (ID_Propietario = OWNER_ID AND ID = GALLERY_ID)$$

CREATE DEFINER=`picify`@`localhost` PROCEDURE `UPDATE_GALERIA_NOMBRE` (IN `NEW_NAME` CHAR(64), IN `OWNER_ID` INT, IN `GALLERY_ID` INT)   UPDATE Galerias SET Nombre = NEW_NAME WHERE (ID_Propietario = OWNER_ID AND ID = GALLERY_ID)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `ID` int(11) NOT NULL,
  `Nombre` char(64) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`ID`, `Nombre`, `Descripcion`) VALUES
(2, 'Mascotas', ''),
(3, 'Mascotitas', ''),
(4, 'Historica', ''),
(5, 'JESUS', ''),
(6, 'Escudo / Bandera', ''),
(7, 'Emperador Romano', ''),
(8, 'Paisaje', ''),
(9, 'Animales', ''),
(10, 'Arquitectura', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Exhibidos`
--

CREATE TABLE `Exhibidos` (
  `ID` int(11) NOT NULL,
  `ID_Foto` int(11) NOT NULL,
  `ID_Galeria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Exhibidos`
--

INSERT INTO `Exhibidos` (`ID`, `ID_Foto`, `ID_Galeria`) VALUES
(3, 10, 1),
(5, 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fotografos`
--

CREATE TABLE `Fotografos` (
  `ID` int(11) NOT NULL,
  `Nombre` char(64) NOT NULL,
  `Apellido` char(64) NOT NULL,
  `Email` char(64) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Nickname` char(64) NOT NULL,
  `IMG_Perfil` char(64) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Fotografos`
--

INSERT INTO `Fotografos` (`ID`, `Nombre`, `Apellido`, `Email`, `Telefono`, `Nickname`, `IMG_Perfil`, `Fecha_Nacimiento`) VALUES
(1, 'Edgar', 'Karpowicz', 'edgarkarpowicz@gmail.com', '5493541640564', 'Edgarcito', 'Background.png', '2024-11-01'),
(2, 'facundo', 'gómez', 'asoutadet@ubp.edu.ar', '5493735633727', 'facu', '', '2002-07-17'),
(3, 'Manuel', 'Nicolais', 'manue@gmai.com', '1234566789', 'manue', 'a707fe8c23a3cdf1e206511083abb337.png', '2003-09-17'),
(4, 'Dumb', 'Mmy', 'dummy@ubp.edu.ar', '3515332332', 'Dummy', '', '2010-05-02'),
(5, 'Jefe', 'test', 'testing@live.com', '0123456789', 'Eterno', '', '2009-06-10'),
(9, 'Manuell', 'Nicolaiss', 'manueqq@gmai.com', '+54 2945408050', 'manuee', 'IMG_2444.JPEG', '2024-10-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fotos`
--

CREATE TABLE `Fotos` (
  `ID` int(11) NOT NULL,
  `Nombre` char(64) NOT NULL,
  `Owner` char(64) NOT NULL,
  `Fecha` date NOT NULL,
  `Descripcion` text NOT NULL,
  `Latitud` float NOT NULL,
  `Longitud` float NOT NULL,
  `ID_Categoria` int(11) NOT NULL,
  `Country` char(64) NOT NULL,
  `ID_Propietario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Fotos`
--

INSERT INTO `Fotos` (`ID`, `Nombre`, `Owner`, `Fecha`, `Descripcion`, `Latitud`, `Longitud`, `ID_Categoria`, `Country`, `ID_Propietario`) VALUES
(10, 'OC-OG.png', 'Edgarcito', '2024-09-05', 'Oda', 0, 0, 6, 'Not found', 1),
(11, 'Genghis Khan (Circle).png', 'Edgarcito', '2024-08-06', 'Genghis Khan o Temujin - Khan Mongol, su nombre significa Gobernante Universal', 0, 0, 4, 'Not found', 1),
(12, '31aa98b6dc8f794fa7fc26b5e73f2513.png', 'manue', '2024-11-14', 'DIOS', 0, 0, 5, 'Not found', 3),
(15, 'TK-RD.png', 'Edgarcito', '2024-11-15', 'Tokugawa', 0, 0, 4, 'Not found', 1),
(16, 'Perro_Gonza.JPG', 'Edgarcito', '2024-11-15', 'El Perro del Gonza', -31.3425, -64.2265, 2, 'Argentina', 1),
(17, 'Aurelian (Original).jpg', 'Edgarcito', '2024-11-15', 'Emperador Romano durante la Crisis del Siglo 3, asesinado por sus Pretorianos a pesar de sus logros', 0, 0, 4, 'Not found', 1),
(18, 'desert.jpg', 'Edgarcito', '2024-11-16', 'No es el Sahara', 21.4694, 4.02423, 8, 'Algeria', 1),
(21, '20240515_151726.jpg', 'manue', '2024-11-17', 'Facultad', 0, 0, 9, 'Not found', 3),
(22, 'giza_pyr.jpg', 'Edgarcito', '2024-11-21', 'Piramides de Giza', 30.0075, 31.2119, 4, 'Egypt', 1),
(23, 'arg.png', 'Edgarcito', '2024-11-21', 'Argentina!', 0, 0, 6, 'Not found', 1),
(26, 'kitty.jpeg', 'Edgarcito', '2024-11-21', 'Gatito', 0, 0, 2, 'Not found', 1),
(27, 'IMG_1931.JPEG', 'manue', '2024-11-21', 'nueva descripcion', 40.4168, -3.70042, 10, 'Spain', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Galerias`
--

CREATE TABLE `Galerias` (
  `ID` int(11) NOT NULL,
  `ID_Propietario` int(11) NOT NULL,
  `Nombre` char(64) NOT NULL,
  `Descripcion` text NOT NULL,
  `Visibilidad` tinyint(1) NOT NULL,
  `IMG_Portada` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Galerias`
--

INSERT INTO `Galerias` (`ID`, `ID_Propietario`, `Nombre`, `Descripcion`, `Visibilidad`, `IMG_Portada`) VALUES
(1, 1, 'Mascototas', 'La Mejor Galeria de Mascotas', 0, 'Metternich (Circle).png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Exhibidos`
--
ALTER TABLE `Exhibidos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Foto` (`ID_Foto`),
  ADD KEY `ID_Galeria` (`ID_Galeria`);

--
-- Indices de la tabla `Fotografos`
--
ALTER TABLE `Fotografos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Fotos`
--
ALTER TABLE `Fotos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Categoria_Foto` (`ID_Categoria`),
  ADD KEY `ID_Propietario_Fotografo` (`ID_Propietario`) USING BTREE;

--
-- Indices de la tabla `Galerias`
--
ALTER TABLE `Galerias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Propietario_Galeria` (`ID_Propietario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Exhibidos`
--
ALTER TABLE `Exhibidos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Fotografos`
--
ALTER TABLE `Fotografos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Fotos`
--
ALTER TABLE `Fotos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `Galerias`
--
ALTER TABLE `Galerias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Exhibidos`
--
ALTER TABLE `Exhibidos`
  ADD CONSTRAINT `Exhibidos_ibfk_1` FOREIGN KEY (`ID_Foto`) REFERENCES `Fotos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Exhibidos_ibfk_2` FOREIGN KEY (`ID_Galeria`) REFERENCES `Galerias` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Fotos`
--
ALTER TABLE `Fotos`
  ADD CONSTRAINT `Fotos_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `Categorias` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fotos_ibfk_2` FOREIGN KEY (`ID_Propietario`) REFERENCES `Fotografos` (`ID`);

--
-- Filtros para la tabla `Galerias`
--
ALTER TABLE `Galerias`
  ADD CONSTRAINT `Galerias_ibfk_1` FOREIGN KEY (`ID_Propietario`) REFERENCES `Fotografos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
