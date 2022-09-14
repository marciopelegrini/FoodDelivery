-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 14 sep. 2022 à 15:36
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food`
--

--
-- Déchargement des données de la table `mesures`
--

INSERT INTO `mesures` (`id`, `nom`, `description`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Petit', 'Taille petit environ 6 morceaux', 1, '2022-09-14 13:17:46', '2022-09-14 13:17:46', NULL),
(2, 'Moyenne', 'Taille moyenne, environ 8 morceaux', 1, '2022-09-14 13:17:46', '2022-09-14 13:17:46', NULL),
(3, 'Large', 'Taille grande environ 12\" 12 morceaux', 1, '2022-09-14 13:18:57', '2022-09-14 13:18:57', NULL),
(4, 'Extra large', 'Taille extra grande, environ 14 morceaux', 1, '2022-09-14 13:18:57', '2022-09-14 13:18:57', NULL),
(5, 'Canette', '710 ml', 1, '2022-09-14 14:56:58', '2022-09-14 15:29:46', NULL),
(6, 'Canette ordinaire', '355 ml', 1, '2022-09-14 15:34:23', '2022-09-14 15:34:23', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
