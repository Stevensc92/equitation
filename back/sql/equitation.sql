-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Avril 2017 à 21:29
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `equitation`
--

-- --------------------------------------------------------

--
-- Structure de la table `content_evreux`
--

CREATE TABLE `content_evreux` (
  `title` varchar(255) NOT NULL,
  `txt_distance` text NOT NULL,
  `txt_address` text NOT NULL,
  `txt_mail` text NOT NULL,
  `txt_number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_evreux`
--

INSERT INTO `content_evreux` (`title`, `txt_distance`, `txt_address`, `txt_mail`, `txt_number`) VALUES
('Contact et localisation', 'A 5 mn d\'Evreux\r\n30 mn de Rouen\r\n50 mn de Paris Porte Maillot\r\n\r\nDe Paris : A13 Sortie 15 « Bonnières-Evreux » puis suivre Rouen et sortir à Fauville\r\nDe Rouen/Caen : A13 sortie Louviers puis sortie Evreux-Nétreville\r\nDe Dreux/Chartres : N12 Evreux puis suivre Rouen et sortir à Fauville', '2 Rue de Fauville\r\n27930 HUEST', 'equitationledermann@orange.fr', '02 27 34 17 42');

-- --------------------------------------------------------

--
-- Structure de la table `content_famille`
--

CREATE TABLE `content_famille` (
  `title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_famille`
--

INSERT INTO `content_famille` (`title`, `txt_block_1`) VALUES
('L\'Histoire', 'Près de 50 ans séparent ces images, du grand-père Albert pionnier des centres équestres en France,\r\nà la médaillée olympique Alexandra en passant par\r\nson père Jean-Pierre, cavalier de CSO émérite\r\net fondateur en 1966 de l\'Ecole d\'Equitation Ledermann à Huest près d\'Evreux.');

-- --------------------------------------------------------

--
-- Structure de la table `content_installation`
--

CREATE TABLE `content_installation` (
  `title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_installation`
--

INSERT INTO `content_installation` (`title`, `txt_block_1`) VALUES
('Les installations', 'L\'Ecole d\'Equitation Ledermann dispose d\'une quarantaine de boxes, d\'un\r\nmanège couvert, de plusieurs paddocks et de 2 carrières dont une éclairée et\r\nun vaste spring-garden aux abords de la forêt \r\ncomprenant un terrain en herbe et un parcours de cross.');

-- --------------------------------------------------------

--
-- Structure de la table `content_philosophie`
--

CREATE TABLE `content_philosophie` (
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL,
  `txt_block_2` text NOT NULL,
  `txt_block_3` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_philosophie`
--

INSERT INTO `content_philosophie` (`title`, `sub_title`, `txt_block_1`, `txt_block_2`, `txt_block_3`) VALUES
('Notre philosophie', '', 'Nous proposons à tous un enseignement à la fois \r\nclassique et attractif qui permet de monter\r\nen toute sécurité et avec plaisir \r\naussi bien en promenade qu’en compétition.', 'Nos priorités : la mise en confiance du cavalier\r\net le respect du cheval.\r\nNos buts : instaurer entre vous et le cheval une relation\r\nbasée sur la confiance, la complicité et le plaisir partagé.', 'Venez nous voir, nous nous ferons un plaisir \r\nde vous faire découvrir \r\nce que nous pratiquons et enseignons depuis 50 ans.');

-- --------------------------------------------------------

--
-- Structure de la table `content_school`
--

CREATE TABLE `content_school` (
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL,
  `txt_block_2` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_school`
--

INSERT INTO `content_school` (`title`, `sub_title`, `txt_block_1`, `txt_block_2`) VALUES
('L\'Ecole d\'Equitation Ledermann', 'De la balade en forêt au plus haut niveau de compétition', 'Que vous souhaitiez découvrir les joies\r\nde l\'équitation en toute sécurité,\r\naller plus loin dans la connaissance du cheval, ou encore améliorer vos performances en compétition,\r\nvous trouverez un accompagnement\r\npersonnalisé de qualité qui saura\r\nrépondre à vos attentes.', 'L\'Ecole d\'Equitation Ledermann situé\r\nà Huest près d\'Evreux en Normandie\r\na formé plusieurs champions,\r\nnotamment Alexandra Ledermann,\r\nmédaille de bronze en individuel aux\r\nJeux Olympiques d\'Atlanta et 1ère\r\nfemme Championne d\'Europe de Saut d\'Obstacles.');

-- --------------------------------------------------------

--
-- Structure de la table `content_service`
--

CREATE TABLE `content_service` (
  `title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL,
  `txt_block_2` text NOT NULL,
  `txt_block_3` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_service`
--

INSERT INTO `content_service` (`title`, `txt_block_1`, `txt_block_2`, `txt_block_3`) VALUES
('Les services', '<span class="bold">Cours d\'Equitation du débutant au confirmé\r\nà partir de 8 ans</span>\r\n\r\n<span class="bold">Promenades</span>', '<span class="bold">Travail et sortie en concours de votre cheval</span>\r\n(Nationaux et Cycle Classique Jeunes Chevaux).\r\n\r\n<span class="bold">Coaching CSO personnalisé</span>\r\n', '<span class="bold">Pension pour votre cheval</span>\r\nde loisir ou de sport\r\n(à la carte selon vos besoins)\r\n\r\n<span class="bold">Débourrage du jeune cheval</span>');

-- --------------------------------------------------------

--
-- Structure de la table `content_tarif`
--

CREATE TABLE `content_tarif` (
  `title` varchar(255) NOT NULL,
  `txt_block_1` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content_tarif`
--

INSERT INTO `content_tarif` (`title`, `txt_block_1`) VALUES
('Les tarifs', '<ul class="tarif_ul">\r\n<li><span class="li-title">Leçons et balades à partir de :</span>\r\n\r\n<span class="bold">22 € / l\'heure</span>\r\n(tarif adhérent)\r\n<span class="bold">36 € / l\'heure</span>\r\n(tarif non adhérent) </li>\r\n<li><span class="li-title">Pensions à partir de :</span>\r\n\r\n<span class="bold">590 € / mois</span></li>\r\n<li>Coaching CSO personnalisé avec\r\n<span class="bold">Jean-Pierre \r\nou \r\nAlexandra Ledermann</span> :\r\nnous consulter</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `access`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$QHt1iEJtXQYsciourPMta.QjU5d91Cyy5wBzeZDT37PlKf66hU9tO', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `content_evreux`
--
ALTER TABLE `content_evreux`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_famille`
--
ALTER TABLE `content_famille`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_installation`
--
ALTER TABLE `content_installation`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_philosophie`
--
ALTER TABLE `content_philosophie`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_school`
--
ALTER TABLE `content_school`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_service`
--
ALTER TABLE `content_service`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `content_tarif`
--
ALTER TABLE `content_tarif`
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_2` (`access`),
  ADD KEY `access` (`access`);

--
-- Index pour la table `user_group`
--
ALTER TABLE `user_group`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
