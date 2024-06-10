-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : lun. 10 juin 2024 à 09:20
-- Version du serveur : 8.4.0
-- Version de PHP : 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `gh_url` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon_url` text NOT NULL,
  `description` varchar(2048) NOT NULL,
  `user_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `gh_url`, `icon_url`, `description`, `user_name`) VALUES
(22, 'DevPet', 'https://github.com/AFCMS/devpet_meta', 'uploads/DevPet.png', 'Un super tamagotchi', 'AFCM'),
(23, 'DevPet2', 'https://github.com/AFCMS/devpet', 'uploads/DevPet2.png', 'Un de sfqsfs', 'AFCM2');

-- --------------------------------------------------------

--
-- Structure de la table `projects_reviews`
--

CREATE TABLE `projects_reviews` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `note` int NOT NULL,
  `text` varchar(2048) NOT NULL
) ;

--
-- Déchargement des données de la table `projects_reviews`
--

INSERT INTO `projects_reviews` (`id`, `project_id`, `user_name`, `note`, `text`) VALUES
(13, 22, 'AFCM', 4, 'Un commentaire '),
(14, 22, 'AFCM2', 2, 'fsfgff');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `name` varchar(10) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Utilisateurs';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`name`, `password`) VALUES
('AFCM', '$2y$10$a6SdtxdNt4pF3tkTObQ04.eQkU16PhXyImt8C.HLfLFhiYDkXLscy'),
('AFCM2', '$2y$10$Fs/WLY/zpdjCFEaLWyS.aOd8x.1Zgmkbdv7t3rbuN/5X0zen31a.S');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `gh_url` (`gh_url`),
  ADD KEY `user_name` (`user_name`);

--
-- Index pour la table `projects_reviews`
--
ALTER TABLE `projects_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_id` (`project_id`,`user_name`),
  ADD KEY `user_name` (`user_name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `projects_reviews`
--
ALTER TABLE `projects_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projects_reviews`
--
ALTER TABLE `projects_reviews`
  ADD CONSTRAINT `projects_reviews_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_reviews_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
