-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 nov. 2024 à 21:19
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ci4`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `cin` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `id_voiture` varchar(255) NOT NULL,
  `date_vonte` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `cin`, `nom`, `prenom`, `Email`, `id_voiture`, `date_vonte`) VALUES
(30, 'DD20806', 'Oumar', 'Amiri', 'oumaramir@gmail.com', 'E98760V34', '2024-11-02'),
(34, 'TT20806', 'EL KHOUMMASSI', 'Oumaima', 'oumaimaelkhommassi@gmail.com', 'B98765T21', '2024-11-12'),
(35, 'BB20806', 'Amal', 'Aya', 'Amalaya@gmail.com', 'E98760V34', '2024-11-12');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `Num_vehicule` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `colore` varchar(255) NOT NULL,
  `kilomite` int(11) NOT NULL,
  `boite_vitesse` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `garantie` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `Num_vehicule`, `marque`, `model`, `colore`, `kilomite`, `boite_vitesse`, `prix`, `garantie`, `status`) VALUES
(1, 'A12345R45', 'Dacia', 'Jogger\r\n', 'noire', 1000, 'Automatique', 190900, '3ans', 'disponiple'),
(2, 'B98765T21', 'Renault', 'Clio', 'rouge', 5000, 'Manuelle', 135000, '2ans', 'disponible'),
(3, 'C65432U18', 'Peugeot', '208', 'bleu', 2000, 'Automatique', 150000, '1an', 'disponible'),
(4, 'D54321Q99', 'Ford', 'Focus', 'blanche', 7500, 'Manuelle', 180000, '3ans', 'vendue'),
(5, 'E98760V34', 'Toyota', 'Corolla', 'grise', 1200, 'Automatique', 220000, '2ans', 'disponible'),
(6, 'F12345L56', 'Volkswagen', 'Golf', 'verte', 3100, 'Manuelle', 195000, '1an', 'réservée');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
