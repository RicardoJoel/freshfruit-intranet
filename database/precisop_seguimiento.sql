-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2020 a las 19:43:53
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `precisop_seguimiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bussiness`
--

CREATE TABLE `bussiness` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bussiness`
--

INSERT INTO `bussiness` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banca, finanzas y aseguradoras', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(2, 'Consumo masivo', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(3, 'Retail', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(4, 'Energía y minas', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(5, 'Consultoría', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(6, 'Automóviles', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(7, 'Publicidad y marketing', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(8, 'Sector público', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(9, 'Coaching', '2020-10-21 22:27:20', '2020-10-21 22:27:20', NULL),
(10, 'Proyectos propios', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(11, 'Agroexportación', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(12, 'Contenidos', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(13, 'Immobiliaria', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(14, 'Educación', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `business_id`, `ruc`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '', 'alDía', 'ALD', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(2, 2, '', 'Alicorp', 'ALC', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(3, 1, '', 'Asociación de AFP', 'AFP', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(4, 3, '', 'Asociación de Centros Comerciales del Perú (ACCEP)', 'CCP', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(5, 11, '', 'Asociación de Gremios Productores Agrarios del Perú (AGAP)', 'AGP', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(6, 1, '', 'Asociación Peruana de Empresas de Seguros (APESEG)', 'APS', '2020-10-21 22:27:21', '2020-10-21 22:27:21', NULL),
(7, 4, '', 'Barrick', 'BRK', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(8, 4, '', 'Cálidda', 'CLD', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(9, 5, '', 'Cooperación Alemana (GIZ)', 'GIZ', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(10, 1, '', 'Defensoría del Asegurado (DEFASEG)', 'DAS', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(11, 6, '', 'DERCO', 'DRC', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(12, 1, '', 'Grupo SURA', 'SUR', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(13, 7, '', 'Grupo Valora (Effie Perú)', 'EFF', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(14, 7, '', 'Interactive Advertising Bureau Perú (iab Perú)', 'IAB', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(15, 1, '', 'Interbank', 'IBK', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(16, 1, '', 'Izipay', 'IZP', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(17, 8, '', 'Lima 2019', 'LIM', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(18, 7, '', 'McCann Lima', 'MCC', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(19, 1, '', 'Mibanco', 'MBC', '2020-10-21 22:27:22', '2020-10-21 22:27:22', NULL),
(20, 8, '', 'Ministerio de Economía y Finanzas', 'MEF', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(21, 8, '', 'Ministerio de Relaciones Exteriores', 'MRE', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(22, 8, '', 'Ministerio de Transportes y Comunicaciones', 'MTC', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(23, 8, '', 'Municipalidad de Lima', 'MLI', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(24, 9, '', 'Nancy Cooklin', 'CKL', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(25, 8, '', 'Osiptel', 'OSP', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(26, 8, '', 'Presidencia del Consejo de Ministros', 'PCM', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(27, 8, '', 'PromPerú', 'PMP', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(28, 10, '', 'Preciso - Agencia de Contenidos', 'PRE', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(29, 4, '', 'Sociedad Nacional de Minería, Petróleo y Energía (SNMPE)', 'SNM', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(30, 7, '', 'SrBurns', 'SRB', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(31, 7, '', 'Wunderman Thompson', 'WTP', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(32, 11, '', 'Fruglobe', 'FGL', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(33, 10, '', 'FreshFruit Perú', 'FFP', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(34, 4, '', 'AngloAmerican', 'QVC', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(35, 13, '', 'Casas de Chile', 'CCL', '2020-10-21 22:27:23', '2020-10-21 22:27:23', NULL),
(36, 8, '', 'Ministerio de Energía y Minas', 'MEM', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(37, 1, '', 'Asbanc', 'ASB', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(38, 1, '', 'Pacífico Seguros', 'PCF', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(39, 3, '', 'Real Plaza', 'RPZ', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(40, 1, '', 'Intercorp', 'ICP', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(41, 1, '', 'Banbif', 'BIF', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(42, 3, '', 'Supermercados Peruanos', 'SPM', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(43, 14, '', 'Colegios Peruanos', 'CPE', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_20_170339_create_project_types_table', 1),
(5, '2020_08_20_172143_create_businesses_table', 1),
(6, '2020_08_20_172624_create_customers_table', 1),
(7, '2020_08_20_175204_create_projects_table', 1),
(8, '2020_08_20_190956_create_activities_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `project_type_id`, `customer_id`, `manager_id`, `code`, `name`, `status`, `approved_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 28, 1, 'OTR000000PRETEM', 'Otros temas', 'Abierto', NULL, '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(2, 4, 28, 1, 'OTR000000PREVAC', 'Vacaciones', 'Abierto', NULL, '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(3, 4, 28, 1, 'OTR000000PREPER', 'Permiso', 'Abierto', NULL, '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(4, 4, 28, 1, 'OTR000000PREALM', 'Almuerzo', 'Abierto', NULL, '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(5, 2, 1, 1, 'PUB300419ALDNTS', 'Notas', 'Abierto', '2019-04-30', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(6, 2, 3, 1, 'PUB051219AFPVFN', 'Video de funcionalidad (adicional)', 'Abierto', '2019-12-05', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(7, 2, 6, 1, 'PUB010519APSFEE', 'Contrato APESEG - FEE', 'Abierto', '2019-05-01', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(8, 2, 13, 1, 'PUB021219EFFPGW', 'Página web de Effie', 'Abierto', '2019-12-02', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(9, 2, 13, 1, 'PUB080419EFFRDS', 'Redes sociales', 'Abierto', '2019-04-08', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(10, 2, 9, 1, 'PUB170619GIZGTC', 'Guía de transporte y cambio climático', 'Abierto', '2019-06-17', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(11, 2, 9, 1, 'PUB080819GIZAGT', 'Agendas territoriales', 'Abierto', '2019-08-08', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(12, 2, 9, 1, 'PUB051219GIZMDG', 'Memoria digital', 'Abierto', '2019-12-05', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(13, 2, 17, 1, 'PUB040919LIMINS', 'Memoria Institucional', 'Abierto', '2019-09-04', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(14, 2, 19, 1, 'PUB260419MBCCFI', 'Consultorio Financiero', 'Abierto', '2019-04-26', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(15, 2, 24, 1, 'PUB051219CKLLBR', 'Libro de Coaching', 'Abierto', '2019-12-05', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(16, 2, 26, 1, 'PUB251119PCMSUT', 'Manual SUT', 'Abierto', '2019-11-25', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(17, 2, 26, 1, 'PUB271219PCMPSC', 'PROMSACE', 'Abierto', '2019-12-27', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(18, 2, 29, 1, 'PUB250619SNMPHE', 'Piezas de hidrocarburos y energía', 'Abierto', '2019-06-25', '2020-10-21 22:27:25', '2020-10-21 22:27:25', NULL),
(19, 2, 12, 1, 'PUB051219SURVTT', 'Videos Tutoriales', 'Abierto', '2019-12-05', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(20, 2, 12, 1, 'PUB010120SURFEE', 'Contrato SURA - FEE', 'Abierto', '2020-01-01', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(21, 1, 4, 1, 'CON080120CCPBRC', 'Brochure Accep', 'Abierto', '2020-01-08', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(22, 2, 10, 1, 'PUB080120DASPGW', 'Página web Defensoría del Asegurado', 'Abierto', '2020-01-08', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(23, 2, 28, 1, 'PUB010120PREL25', 'Libro Effie 25 Años', 'Abierto', '2020-01-01', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(24, 2, 31, 1, 'PUB061219WTPCIM', 'Lima 2019 - Comunicaciones: Impresión', 'Abierto', '2019-12-06', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(25, 2, 31, 1, 'PUB101019WTPCCO', 'Lima 2019 - Comunicaciones: Contenido', 'Abierto', '2019-10-10', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(26, 3, 32, 1, 'FFP100120FGLRPP', 'Fruglobe - Reporte de palta 2020', 'Abierto', '2020-01-10', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(27, 3, 33, 1, 'FFP010120FFPFSN', 'FreshNews', 'Abierto', '2020-01-01', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(28, 3, 33, 1, 'FFP010120FFPFSD', 'FreshData', 'Abierto', '2020-01-01', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(29, 3, 33, 1, 'FFP010120FFPFSR', 'FreshReport', 'Abierto', '2020-01-01', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(30, 2, 25, 1, 'PUB170120OSPMEC', 'Memoria Institucional - Edición y Corrección de Estilo', 'Abierto', '2020-01-17', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(31, 2, 12, 1, 'PUB200120SURVFC', 'Videos Factoring', 'Abierto', '2020-01-20', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(32, 2, 25, 1, 'PUB220120OSPMDG', 'Memoria Institucional - Diseño y Diagramación', 'Abierto', '2020-01-22', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(33, 2, 19, 1, 'PUB290120MBCRPC', 'Redes Personales Corporativas', 'Abierto', '2020-01-29', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(34, 2, 1, 1, 'PUB310120ALDCMJ', 'Contenidos Mi Junta', 'Abierto', '2020-01-31', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(35, 2, 11, 1, 'PUB050220DRCCEC', 'Caso Effie - Citroën', 'Abierto', '2020-02-05', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(36, 2, 11, 1, 'PUB050220DRCCER', 'Caso Effie - Renault', 'Abierto', '2020-02-05', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(37, 2, 23, 1, 'PUB090220MLICML', 'Casos CAD', 'Abierto', '2020-02-09', '2020-10-21 22:27:26', '2020-10-21 22:27:26', NULL),
(38, 2, 15, 1, 'PUB060220IBKSTB', 'Reporte de Sostenibilidad', 'Abierto', '2020-02-06', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(39, 2, 35, 1, 'PUB030220CCLLTE', 'Estudio de Lote', 'Abierto', '2020-02-03', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(40, 2, 34, 1, 'PUB200220QVCCTN', 'Contenidos Digitales', 'Abierto', '2020-02-20', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(41, 1, 36, 1, 'CON260220MEMMIN', 'Consultoría Planificación Minera', 'Abierto', '2020-02-26', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(42, 2, 15, 1, 'PUB030320IBKCEI', 'Casos Effie - Interbank', 'Abierto', '2020-03-03', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(43, 2, 14, 1, 'PUB050320IABEVN', 'Eventos iab 2020', 'Abierto', '2020-03-05', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(44, 2, 14, 1, 'PUB030320IABEBK', 'eBook iabMixx 2020', 'Abierto', '2020-03-03', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(45, 2, 13, 1, 'PUB180320EFFLFI', 'Effie Awards Perú - Libro de Finalistas', 'Abierto', '2020-03-18', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(46, 2, 13, 1, 'PUB200320EFFCJF', 'Effie Awards Perú - Curso de Jurados + Feedback', 'Abierto', '2020-03-20', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(47, 2, 37, 1, 'PUB230320ASBCDI', 'Contenidos Digitales', 'Abierto', '2020-03-23', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(48, 2, 12, 1, 'PUB070420SURVRD', 'Videos Retiro 2,000', 'Abierto', '2020-04-07', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(49, 2, 13, 1, 'PUB270420EFFECL', 'Effie College - Piezas Varias', 'Abierto', '2020-04-27', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(50, 2, 9, 1, 'PUB140520GIZCOV', 'Productos comunicacionales digitales COVID-19', 'Abierto', '2020-05-14', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(51, 2, 9, 1, 'PUB010620GIZCPM', 'Asesoría Capacita+', 'Abierto', '2020-06-01', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(52, 1, 9, 1, 'CON010620GIZSAL', 'Sistematización Avances y logros del proyecto PCM-UE/GIZ/AECID', 'Abierto', '2020-06-01', '2020-10-21 22:27:27', '2020-10-21 22:27:27', NULL),
(53, 2, 34, 1, 'PUB230620QVCVTE', 'Videos Tu Empresa', 'Abierto', '2020-06-23', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(54, 2, 19, 1, 'PUB100620MBCCRM', 'Columna Relevancia Microempresa COVID-19', 'Abierto', '2020-06-10', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(55, 2, 34, 1, 'PUB010720QVCDEM', 'Desayunos Empresariales', 'Abierto', '2020-07-01', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(56, 2, 38, 1, 'PUB140820PCFCAN', 'Desarrollo de Casos ANDA', 'Abierto', '2020-08-14', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(57, 2, 39, 1, 'PUB010920RPZCEF', 'Desarrollo de Casos Effie', 'Abierto', '2020-09-01', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(58, 2, 40, 1, 'PUB280820ICPCOC', 'Estructura Contenidos COVID-19', 'Abierto', '2020-08-28', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(59, 2, 41, 1, 'PUB010920BIFDCE', 'Desarrollo Casos Effie', 'Abierto', '2020-09-01', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(60, 2, 16, 1, 'PUB040920IZPDCE', 'Desarrollo Casos Effie', 'Abierto', '2020-09-04', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(61, 2, 42, 1, 'PUB080920SPMDCE', 'Desarrollo Casos Effie', 'Abierto', '2020-09-08', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL),
(62, 2, 43, 1, 'PUB100929CPEDCE', 'Desarrollo Casos Effie', 'Abierto', '2029-09-10', '2020-10-21 22:27:28', '2020-10-21 22:27:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_types`
--

CREATE TABLE `project_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `project_types`
--

INSERT INTO `project_types` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Consultoría', 'CON', 'Proyectos de consultoría en general.', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(2, 'Contenidos', 'PUB', 'Proyectos de contenidos impresos, digitales, audiovisuales o vivenciales.', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(3, 'FreshFruit', 'FFP', 'Proyectos relacionados a FreshFruit Perú.', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL),
(4, 'Otros', 'OTR', 'Otro tipos de proyecto.', '2020-10-21 22:27:24', '2020-10-21 22:27:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `is_admin`, `is_blocked`, `name`, `lastname`, `document`, `telephone`, `email`, `email_verified_at`, `password`, `confirmation_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 'Administrador', NULL, NULL, NULL, 'admin@preciso.pe', '2020-10-21 22:27:19', '$2y$10$R9MrGULc/CrND7.admt4BunTWtd1XZkS/0DuiWWgcP7oL3krHLDmG', 'uJ1RWt3dbmnYU3KjdJVrhMJfKcx0XuMB0MwFbpbX5fAmd6mq7Vy2Fx3pOe3v', NULL, '2020-10-21 22:27:19', '2020-10-21 22:27:19', NULL),
(2, 0, 0, 'Ricardo', 'Béjar', '70689935', '991267284', 'rbejar@preciso.pe', '2020-10-21 22:27:19', '$2y$10$7.v8lg.N4kwfVYt/1Cu6TuV4jk1wamsRz6UAWNbyOG1VYYMVNXmSO', 'ex9yx648XZH9hUetP0HcmscQv2HJuUSvJUgR2YlIgwASylZWVa8xZC8lMxwn', NULL, '2020-10-21 22:27:19', '2020-10-21 22:27:19', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_foreign` (`user_id`),
  ADD KEY `activities_project_id_foreign` (`project_id`);

--
-- Indices de la tabla `bussiness`
--
ALTER TABLE `bussiness`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `customers_business_id_foreign` (`business_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `projects_project_type_id_foreign` (`project_type_id`),
  ADD KEY `projects_customer_id_foreign` (`customer_id`),
  ADD KEY `projects_manager_id_foreign` (`manager_id`);

--
-- Indices de la tabla `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_types_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bussiness`
--
ALTER TABLE `bussiness`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `project_types`
--
ALTER TABLE `project_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `bussiness` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_project_type_id_foreign` FOREIGN KEY (`project_type_id`) REFERENCES `project_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
