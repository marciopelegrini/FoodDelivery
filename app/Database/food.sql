-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 22 août 2022 à 15:39
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

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2022-08-15-013041', 'App\\Database\\Migrations\\CreateUserTable', 'default', 'App', 1660571073, 1),
(3, '2022-08-17-130221', 'App\\Database\\Migrations\\CreationTableUsager', 'default', 'App', 1660741399, 2);

-- --------------------------------------------------------

--
-- Structure de la table `usagers`
--

CREATE TABLE `usagers` (
  `id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `courriel` varchar(128) NOT NULL,
  `assurance_maladie` varchar(15) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `password_hash` varchar(255) NOT NULL,
  `activation_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expiry_in` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `usagers`
--

INSERT INTO `usagers` (`id`, `nom`, `courriel`, `assurance_maladie`, `telephone`, `is_admin`, `actif`, `password_hash`, `activation_hash`, `reset_hash`, `reset_expiry_in`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcio Andrei gomes', 'mar@mar.ca', 'pelm 123', '', 1, 0, '', NULL, NULL, NULL, '2022-08-17 09:03:33', '2022-08-17 15:22:36', NULL),
(2, 'Marisa Molaia', 'mamol@mar.ca', 'molm123', '', 0, 0, '', NULL, NULL, NULL, '2022-08-17 13:03:33', '2022-08-17 09:26:33', NULL),
(3, 'Steve Jobs', 'steve@jobs.ca', 'jobs 8977 9879', '(987) 987-9879', 0, 1, '$2y$10$kSqiCiveae3MaXeABAkJCuEEPFQd0RCZ6UkmeK.pN3ct0RZrfMauS', NULL, NULL, NULL, '2022-08-22 08:11:42', '2022-08-22 09:22:20', '2022-08-22 09:22:20'),
(4, 'Gill Bates', 'bates@gill.ca', 'bate 0809 8080', '(808) 808-0809', 1, 1, '$2y$10$TNXxWIPMruzYpe41jPacRO0dWvwC6YGqNWhb1xOSA36crE4KekPpC', NULL, NULL, NULL, '2022-08-22 08:12:33', '2022-08-22 09:18:35', NULL),
(5, 'Steve Wozniack', 'woz@woz.ca', 'iwur 8923 4598', '(987) 907-0897', 0, 1, '$2y$10$Wi0BYfx8XgcUEp1LYiVVq.LHBHB9Vw2jhRuAHueFAK5MlA1bKsOR2', NULL, NULL, NULL, '2022-08-22 10:19:53', '2022-08-22 10:19:53', NULL),
(6, 'Jeff Bezos', 'piroca@bezzos.ca', 'bezo 9889 7979', '(897) 897-8979', 0, 1, '$2y$10$b82pVk/al3TRkYVfG7Ht0./iqquiwbn92g2unTWBFD3M59Bk5i82y', NULL, NULL, NULL, '2022-08-22 10:20:28', '2022-08-22 10:20:28', NULL),
(7, 'Elon Musk', 'musk@tesla.ca', 'musk 0809 8098', '(098) 098-9080', 0, 1, '$2y$10$076Fv6Dlus5OrsfpDlckxedg/Rf7Zn88Yl00txG3seQNRXtJeuyMe', NULL, NULL, NULL, '2022-08-22 10:20:59', '2022-08-22 10:20:59', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usagers`
--
ALTER TABLE `usagers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courriel` (`courriel`),
  ADD UNIQUE KEY `activation_hash` (`activation_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `usagers`
--
ALTER TABLE `usagers`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
