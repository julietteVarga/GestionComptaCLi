-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 avr. 2021 à 15:54
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `saisiecomptav2`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `rue`, `ville`, `cp`, `pays`) VALUES
(1, '9 rue Julles Rieffel', 'Rennes', '35000', 'France'),
(2, '9 allée d\'enfance 35820 ', 'La Janais', '35310', 'France'),
(3, 'rue de la fontaine', 'Cesson sévigne', '35350', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL,
  `type_de_paiement_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `numero_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `numero_cheque_ou_paypal` int(11) DEFAULT NULL,
  `montant` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `consultant_id`, `type_de_paiement_id`, `service_id`, `numero_facture`, `date`, `numero_cheque_ou_paypal`, `montant`) VALUES
(1, 1, 1, 1, '2021-04-0001', '2021-04-07', 2147483647, 80),
(2, 2, 2, 2, '2021-08-0003', '2021-05-07', 2147483647, 100.15),
(3, 3, 3, 3, '2021-06-0006', '2021-06-11', NULL, 150);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int(11) NOT NULL,
  `createur_id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `heure` datetime NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `createur_id`, `consultant_id`, `titre`, `date`, `heure`, `commentaire`) VALUES
(1, 4, 1, 'Rendez-vous avec  M.Tom Cruise', '2021-04-19', '2021-04-30 15:28:00', 'le consultant est en amélioration depuis sa dernière scéance'),
(2, 5, 2, 'Rendez-vous avec  M.Pierre Dupont', '2021-05-28', '2021-04-30 14:15:00', NULL),
(3, 6, 3, 'Rendez-vous avec  Mm.Princesse charline', '2021-06-08', '2021-04-30 11:55:00', 'Princesse Charline vient pour la première fois ');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER'),
(3, 'ROLE_CONSULTANT');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `libelle`) VALUES
(1, 'Nettoyage lieu de vie'),
(2, 'Soin Reiki'),
(3, 'Passeur d\'âme'),
(4, 'Soin à distance'),
(5, 'Soin'),
(6, 'Soin sur les animaux'),
(7, 'Formation'),
(8, 'Atelier'),
(9, 'Formation en ligne');

-- --------------------------------------------------------

--
-- Structure de la table `type_de_paiement`
--

CREATE TABLE `type_de_paiement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_de_paiement`
--

INSERT INTO `type_de_paiement` (`id`, `libelle`) VALUES
(1, 'Chèque'),
(2, 'Espèce'),
(3, 'Paypal'),
(4, 'Virement bancaire'),
(5, 'Carte bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `adresse_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_naissance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_naissance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `heure_naissance` datetime DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `adresse_id`, `nom`, `prenom`, `tel`, `email`, `username`, `roles`, `password`, `type`, `ville_naissance`, `pays_naissance`, `date_naissance`, `heure_naissance`, `sex`) VALUES
(1, 1, 'Tom', 'Cruise', '064582354', 'tomcuise@gmail.com', 'tommy', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$R3ZoSE5mMllZVDh2UTBQVg$ckBBvfD+L/8Our13KwG5yLzn2869tJyUFL3RMTjWGRI', 'consultant', 'Syracuse', 'USA', '1962-07-03', '2021-04-30 00:00:00', 'Masculin'),
(2, 2, 'Pierre', 'Dupont', '0745235665', 'pierredupont@gmail.com', 'pierrot', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$OVR2eUhUejdnYzhPTzNLSw$ovLlnECaWYIj9nExjE4EybNtcwOYftXUNqQr8BVVXyw', 'consultant', 'Rennes', 'France', '1970-07-03', '2021-04-30 13:52:00', 'Masculin'),
(3, 3, 'Princesse', 'charline', '064752564', 'p.charle@gmail.com', 'charline', '[\"ROLE_CONSULTANT\"]', '$argon2id$v=19$m=65536,t=4,p=1$UGZoZFhSdVJLbC9sdzJYag$cMNm1UbJ1xXaB0A83n5/zLqNU/evPUSgjvPScD1njnE', 'consultant', 'Paris', 'France', '1991-10-14', '2021-04-30 07:20:00', 'Feminin'),
(4, NULL, 'Energie', 'Denis Sanchez', '853478254', 'contact@energie-denis-sanchez.fr', 'admin', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$MHF6cDc3Y1ZHaElzYUNjMA$f3iXS5g0KitkICbCc4X2/YXQX1hc3DccJqH2UA/WE08', 'user', NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'Sanchez', 'Denis', '853478254', 'dsanchez@eni-ecole.fr', 'denis', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$T1Q1d1lZZXNpSlRmNHlMcg$blqGu9r+wnRA6gWt1zgMsz7k3GC8Jp/wKyk7egnqQNc', 'user', NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Zahafi', 'Mohamed', '853478254', 'momo@eni-ecole.fr', 'Momo', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$MEYvOVZpam9WSi5mdTJDZg$v/WDHbDi6hXv5uM9cWBzgtOAv3qJJyRQt3BaY+xxDUM', 'user', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE86641044F779A2` (`consultant_id`),
  ADD KEY `IDX_FE866410EF109C5` (`type_de_paiement_id`),
  ADD KEY `IDX_FE866410ED5CA9E6` (`service_id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65E8AA0A73A201E5` (`createur_id`),
  ADD KEY `IDX_65E8AA0A44F779A2` (`consultant_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_de_paiement`
--
ALTER TABLE `type_de_paiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D6494DE7DC5C` (`adresse_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `type_de_paiement`
--
ALTER TABLE `type_de_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE86641044F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FE866410ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_FE866410EF109C5` FOREIGN KEY (`type_de_paiement_id`) REFERENCES `type_de_paiement` (`id`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `FK_65E8AA0A44F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_65E8AA0A73A201E5` FOREIGN KEY (`createur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6494DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
