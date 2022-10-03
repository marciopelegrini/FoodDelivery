-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 03 oct. 2022 à 19:13
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.1.6

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
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `slug`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pizzas traditionnelles', 'pizzas-traditionnelles', 1, '2022-09-12 13:51:32', '2022-09-12 13:51:32', NULL),
(2, 'Desserts', 'desserts', 1, '2022-09-12 13:51:44', '2022-09-12 13:51:44', NULL),
(3, 'Pizzas sucrées', 'pizzas-sucrees', 1, '2022-09-12 13:52:06', '2022-09-12 13:52:06', NULL),
(4, 'Beuvrages', 'beuvrages', 1, '2022-09-12 13:52:24', '2022-09-12 13:52:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `extras`
--

DROP TABLE IF EXISTS `extras`;
CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `extras`
--

INSERT INTO `extras` (`id`, `nom`, `slug`, `prix`, `description`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bacon importé', 'bacon-importe', '3.00', 'Bacon extra fumé', 1, '2022-09-12 19:56:16', '2022-09-13 15:07:24', NULL),
(2, 'Fromage', 'fromage-extra', '3.00', 'Extra de fromage rapé', 1, '2022-09-12 19:56:16', '2022-09-22 14:22:31', NULL),
(3, 'Sauce aux tomates', 'sauce-aux-tomates', '0.50', 'Sauce aux tomates frais', 1, '2022-09-13 15:23:13', '2022-09-13 15:23:13', NULL),
(5, 'Fromage feta', 'fromage-feta', '3.00', 'fromage feta', 1, '2022-09-13 15:35:10', '2022-09-13 15:39:48', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

DROP TABLE IF EXISTS `mesures`;
CREATE TABLE `mesures` (
  `id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
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
(3, '2022-08-17-130221', 'App\\Database\\Migrations\\CreationTableUsager', 'default', 'App', 1660741399, 2),
(4, '2022-08-24-235452', 'App\\Database\\Migrations\\CreerTableCategories', 'default', 'App', 1663005038, 3),
(5, '2022-08-27-004219', 'App\\Database\\Migrations\\CreerTableExtras', 'default', 'App', 1663005038, 3),
(6, '2022-09-14-131541', 'App\\Database\\Migrations\\CreerTableMesures', 'default', 'App', 1663870356, 4),
(7, '2022-09-22-183713', 'App\\Database\\Migrations\\CreerTableProduits', 'default', 'App', 1663872524, 5);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE `produits` (
  `id` int(5) UNSIGNED NOT NULL,
  `categorie_id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ingredients` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `categorie_id`, `nom`, `slug`, `ingredients`, `photo`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '4 fromages', '4-fromages', 'pate, sauce, cheddar, mozzarella, feta, parmesan', '1664816270_c94209db6ea24433da4a.jpg', 1, '2022-09-22 14:49:05', '2022-09-22 14:49:05', NULL),
(2, 1, 'Pepperoni', 'pepperoni', 'pepperoni', '1664816358_c78be35396c4d9d14920.jpg', 1, '2022-09-22 14:49:05', '2022-09-22 14:49:05', NULL),
(3, 4, 'Coca-Cola', 'coca-cola', '', '1664816429_8d09b57a8cff4ec35527.jpg', 1, '2022-09-22 14:52:10', '2022-09-22 14:52:10', NULL),
(4, 2, 'Tiramissu', 'tiramissu', 'tiramissu', '1664816467_ecf0f60624b711947d65.jpg', 1, '2022-09-22 14:52:10', '2022-09-22 14:52:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `usagers`
--

DROP TABLE IF EXISTS `usagers`;
CREATE TABLE `usagers` (
  `id` int(5) UNSIGNED NOT NULL,
  `nom` varchar(128) NOT NULL,
  `courriel` varchar(128) NOT NULL,
  `assurance_maladie` varchar(15) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 0,
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
(4, 'Gill Bates', 'bates@gill.ca', 'bate 0809 8080', '(808) 808-0809', 1, 1, '$2y$10$yBf51d5ngCDSIJ34V1NvL.QROnkP.DPLX3WkS5qUHJjgtFQpHutfy', NULL, NULL, NULL, '2022-08-22 08:12:33', '2022-08-24 15:01:41', NULL),
(5, 'Steve Wozniack', 'woz@woz.ca', 'iwur 8923 4598', '(987) 907-0897', 0, 1, '$2y$10$Wi0BYfx8XgcUEp1LYiVVq.LHBHB9Vw2jhRuAHueFAK5MlA1bKsOR2', NULL, NULL, NULL, '2022-08-22 10:19:53', '2022-08-22 10:19:53', NULL),
(6, 'Jeff Bezos', 'piroca@bezzos.ca', 'bezo 9889 7979', '(897) 897-8979', 0, 1, '$2y$10$b82pVk/al3TRkYVfG7Ht0./iqquiwbn92g2unTWBFD3M59Bk5i82y', NULL, NULL, NULL, '2022-08-22 10:20:28', '2022-08-22 10:20:28', NULL),
(7, 'Elon Musk', 'musk@tesla.ca', 'musk 0809 8098', '(098) 098-9080', 0, 1, '$2y$10$8qDSb7QSFb72tWw1Z/HRue3ZAKxipaaG3oUcHqWwhUlf4Uj23ZxIS', NULL, '8052b9e134edcfa0959b5cce5200c4994d95aee196e30e2fe18f8f9f76831b5f', '2022-08-24 15:22:22', '2022-08-22 10:20:59', '2022-08-24 14:50:59', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `produits_categorie_id_foreign` (`categorie_id`);

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
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mesures`
--
ALTER TABLE `mesures`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `usagers`
--
ALTER TABLE `usagers`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
