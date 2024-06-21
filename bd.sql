-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8.remi
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 05 mai 2024 à 19:07
-- Version du serveur : 8.0.36
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `USER`
--

-- --------------------------------------------------------

--
-- Structure de la table `actuality`
--

CREATE TABLE `actuality` (
  `id_actuality` int NOT NULL,
  `date` date DEFAULT (curdate()),
  `subject` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `body` text,
  `is_visible` tinyint(1) DEFAULT '0',
  `fk_department` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `actuality`
--

INSERT INTO `actuality` (`id_actuality`, `date`, `subject`, `image`, `introduction`, `body`, `is_visible`, `fk_department`) VALUES
(6, '2024-05-05', 'Nouveau concept de Bubble Tea', 'fad95a_b342c152411447cdbb5bf3e9f114e966~mv2-6637d43562b8a.jpg', 'Découvrez notre nouveau concept de Bubble Tea !', 'Nous avons repensé le Bubble Tea pour vous offrir des saveurs uniques, des combinaisons audacieuses et une présentation innovante. ', 1, 3),
(7, '2024-05-05', 'Offres spéciales pour les étudiants', 'education-students_4-6637d3bfb56b1.webp', 'Des offres spéciales rien que pour vous, les étudiants !', 'Profitez de tarifs réduits sur une sélection de plats et de boissons avec notre menu étudiant. Que ce soit pour une pause entre les cours ou pour une soirée entre amis, venez profiter de nos offres exclusives. ', 1, 1),
(8, '2024-05-05', 'Menu éphémère pour le printemps', 'download-6637d3843d0b2.jpg', 'Découvrez notre menu éphémère pour le printemps !', 'Découvrez notre tout nouveau menu éphémère, spécialement conçu pour célébrer l\'arrivée du printemps chez Moge-Tee ! ', 1, 2),
(9, '2024-05-05', 'Nouvelle saveur fruitée', 'f0d1762b91fd823a1aa9bd0dab5c648d-6637d332988a5.jpg', 'Savourez notre toute nouvelle saveur fruitée !', 'Découvrez notre toute nouvelle saveur fruitée chez Moge-Tee ! Rafraîchissante et délicieuse, cette création exotique vous transportera dans un voyage gustatif unique.', 1, 3),
(10, '2024-05-05', 'Happy Hour prolongé ce week-end', 'images-6637d2f5888ab.jpg', 'Profitez de notre Happy Hour prolongé ce week-end !', 'Notre Happy Hour est prolongé ce week-end chez Moge-Tee ! Profitez de réductions spéciales sur une sélection de boissons et de plats délicieux. ', 1, 2),
(11, '2024-05-05', 'Offres spéciales pour les groupes', 'depositphotos_25293849-stock-photo-mixed-age-multi-ethnic-group-6637d2aa39019.webp', 'Des offres spéciales pour les groupes et les événements !', 'Chez Moge-Tee, nous proposons des offres spéciales pour les groupes ! Que vous organisiez une sortie en famille, une réunion d\'entreprise ou une fête entre amis, profitez de nos tarifs avantageux et de nos menus personnalisés pour rendre votre événement inoubliable. ', 1, 3),
(12, '2024-05-05', 'Service de livraison maintenant disponible', 'coursier-livraison-de-repas_897x505-6637d2092addf.jpg', 'Faites-vous livrer votre Bubble Tea préféré !', 'Plus besoin de sortir de chez vous pour déguster vos plats préférés de Moge-Tee ! Notre service de livraison est maintenant disponible.', 1, 1),
(13, '2024-05-05', 'Atelier DIY pour les enfants', 'images-6637d19f195a7.jpg', 'Organisez un atelier DIY pour les anniversaires des enfants !', 'Les enfants, préparez-vous pour une journée amusante chez Moge-Tee ! Rejoignez-nous pour nos ateliers DIY où vous pourrez laisser libre cours à votre créativité.', 1, 2),
(14, '2024-05-05', 'Nouveau partenariat avec une association locale', 'images-6637d148161ad.jpg', 'Nous sommes fiers de soutenir notre communauté locale !', 'Grande nouvelle ! Nous sommes fiers d\'annoncer notre nouveau partenariat avec une association locale. ', 1, 3),
(15, '2024-05-05', 'Menu végétalien maintenant disponible', 'download-6637d0ba03604.jpg', 'Dégustez notre délicieux Bubble Tea végétalien !', 'Nouveau chez Moge-Tee ! Découvrez notre menu végétalien désormais disponible. Explorez une variété de plats délicieux et nutritifs, conçus pour ravir vos papilles sans compromis sur le goût. Venez déguster une cuisine végétalienne savoureuse et fraîche chez nous dès aujourd\'hui !', 1, 2),
(16, '2024-05-05', 'Service de traiteur pour vos événements', '4-6637cabc2f8ba.jpg', 'Faites appel à notre service de traiteur pour tous vos événements !', 'Nouveau ! Service de traiteur disponible chez Moge-Tee ! Organisez votre événement en toute tranquillité et régalez vos invités avec nos délices gastronomiques. Contactez-nous pour une expérience culinaire inoubliable !', 1, 3),
(17, '2024-05-05', 'Nouvelles recettes de Bubble Tea maison', '05_bubble-tea-2-scaled-6637c81cc5307.jpg', 'Essayez nos nouvelles recettes de Bubble Tea à faire chez vous !', 'Chers clients,\r\n\r\nNous sommes ravis de vous annoncer le lancement de nos nouvelles recettes de Bubble Tea maison chez Moge-Tee ! Notre équipe de baristas a travaillé dur pour créer des combinaisons uniques de saveurs et d\'ingrédients qui vous raviront.\r\n\r\nVenez découvrir nos créations originales, des classiques revisités aux saveurs exotiques. Que vous soyez fan de Bubble Tea au thé vert, au thé noir ou aux fruits, nous avons quelque chose pour tous les goûts.\r\n\r\nÀ bientôt !\r\n\r\nL\'équipe Moge-Tee', 1, 1),
(18, '2024-05-05', 'Menu pour les amateurs de Bubble Tea traditionnel', 'depositphotos_464880218-stock-photo-row-fresh-boba-bubble-tea-6637c783721de.webp', 'Découvrez notre menu pour les amateurs de Bubble Tea traditionnel !', '\r\n<p>Chers amateurs de Bubble Tea,</p>\r\n<p>Nous sommes ravis de vous présenter notre nouveau <strong>menu pour les amateurs de Bubble Tea traditionnel</strong> chez Moge-Tee ! Découvrez une sélection exquise de saveurs authentiques et rafraîchissantes qui raviront vos papilles.</p>\r\n<p>À bientôt chez Moge-Tee !</p>\r\n<p>L\'équipe Moge-Tee</p>\r\n                                                ', 1, 2),
(19, '2024-05-05', 'Dégustation gratuite ce samedi', 'pexels-olly-3811663-6637c64ce6a5c.jpg', 'Venez découvrir nos saveurs lors de notre dégustation gratuite ce samedi !', '\r\n<p>Chers clients,</p>\r\n<p>Nous avons le plaisir de vous convier à une <strong>dégustation gratuite</strong> ce samedi chez Moge-Tee ! Rejoignez-nous pour une expérience gastronomique unique où vous pourrez découvrir une sélection exquise de nos plats les plus populaires, préparés avec amour par notre talentueuse équipe de chefs.</p>\r\n<p>À bientôt chez Moge-Tee !</p>\r\n<p>L\'équipe Moge-Tee</p>\r\n                                                                                                                                                                                                ', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `department`
--

CREATE TABLE `department` (
  `id_department` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `department`
--

INSERT INTO `department` (`id_department`, `name`) VALUES
(2, 'Anvers'),
(1, 'Bruxelles'),
(3, 'Gand'),
(4, 'Liège');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(2, 'Barista'),
(5, 'Chef'),
(3, 'Manager'),
(1, 'Serveur'),
(4, 'Technicien de surface');

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `description` text,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`id_staff`, `firstname`, `lastname`, `email`, `password_hash`, `phone_number`, `profile_picture`, `description`, `is_admin`) VALUES
(1, 'William', 'Jiang', 'jiang@gmail.com', '$2y$10$DfStBoY0X6EnyCGZmdNjOuESUOD0jfJg392M7bdmIaERk0duO4xgy', '', NULL, '', 1),
(2, 'Jean', 'Dupont', 'jean.dupont@gmail.com', '$2y$10$PtauMMhQCPJimLjhsvEa2.P3Et7daJVjsgacarwv16e.fJM8c7TTG', '0412345678', '9adaaef525f3cef0a88f5dc6ab3141a4-6637b93b2379c.jpg', 'Salut, je suis Jean Dupont. Depuis 5 ans, j\'ai eu le privilège de travailler chez Moge-Tee, un endroit où l\'excellence du service est une norme. En tant que serveur, j\'ai appris à transformer chaque repas en une expérience inoubliable. J\'ai développé une passion pour anticiper les besoins de nos clients et pour créer des moments mémorables à chaque occasion. Chez Moge-Tee, nous ne visons rien de moins que la perfection, et c\'est ce standard que je m\'efforce de maintenir à chaque service. C\'est un honneur de faire partie de cette équipe et de contribuer à la réputation exceptionnelle de notre établissement.', 0),
(3, 'Pierre', 'Lambert', 'pierre.lambert@gmail.com', '$2y$10$dfqese.QMVVUbG6qOf78hOt9Kz1oQaLieokvFKd2R8Uh4h3oSgeDK', '0412345678', '3537a74e76377b44451277eb5c860307-6637bcd5676b5.jpg', 'Salut à tous, je suis Pierre Lambert, et je suis fier de faire partie de l\'équipe de Moge-Tee depuis un bon moment maintenant. En tant que professionnel de l\'hôtellerie-restauration, je suis passionné par la création d\'expériences gastronomiques mémorables pour nos clients. ', 0),
(4, 'Émilie', 'Dubois', 'emilie.dubois@gmail.com', '$2y$10$RRiXg3b2.oVCtKbegKH1z.o0PKmiE0jeX9308izvyfWdV3oV3yEI.', '0498765432', '2c0cebc587532cdb48cae0d1fa905960-6637bdd8c84ed.jpg', 'Salut tout le monde ! Je suis Émilie Dubois, et je suis ravie de faire partie de l\'équipe Moge-Tee. \r\n\r\nJ\'aime apporter ma touche personnelle à chaque plat que je prépare et m\'assurer que nos clients passent un moment délicieux à chaque visite.\r\n\r\nChez Moge-Tee, nous sommes une grande famille et c\'est génial de partager cette passion avec mes collègues. ', 0),
(5, 'Antoine', 'Lambert', 'antoine.lambert@gmail.com', '$2y$10$9VGRUBPa1dasZ1N/G.cB1ODz8PaQusZvBVgTKpOcAMYH4xZ0gONrS', '0445678910', '6b911022b5d6be91e9fa66e94f84773b-6637bf0986649.jpg', 'Salut à tous, je suis Antoine Lambert, le frère de Pierre Lambert, et je suis ravi de rejoindre l\'équipe de Moge-Tee.\r\n\r\nTravailler dans l\'horeca est quelque chose que j\'ai toujours admiré chez mon frère, et maintenant, je suis excité de vivre cette expérience moi-même. \r\n\r\nJ\'apporte ma propre énergie et mon enthousiasme à chaque service, et je suis déterminé à offrir à nos clients une expérience exceptionnelle à chaque fois qu\'ils franchissent nos portes. ', 0),
(6, 'Marguerite', 'Durand', 'marguerite.durand@gmail.com', '$2y$10$OuX8PfOOYZ/HpE9qPGLEOuNyTtc1hrjhfdKLlU.4Av5ZOrBMDJuIu', '0423456789', '42df96a8ac93c6b72e2645b7e4a7f939-6637bfe549aef.jpg', 'Bonjour à tous, je m\'appelle Marguerite Durand, et je suis ravie de faire partie de l\'équipe de Moge-Tee en tant que technicienne de surface.\r\n\r\nAvec des années d\'expérience à mon actif, je suis fière d\'être la doyenne de notre belle ville. \r\n\r\nChez Moge-Tee, je m\'efforce de maintenir un environnement propre et accueillant pour nos clients. Je prends soin de chaque détail, car je crois que la propreté contribue à une expérience culinaire agréable.', 0),
(7, 'Thomas', 'Van den Berghe', 'thomas.vandenberghe@moge-tee.com', '$2y$10$JCEOmj1rVdYbd74VcJ9Y4erCLrzvWCvhoMQ1rNd3QhnFXwQxjMIv6', '0456789012', '8ba8e5b2f6bf6f311e2ef371de214872-6637c1021567e.jpg', 'Bonjour à tous, je suis Thomas Van den Berghe, le manager du département d\'Anvers chez Moge-Tee. Avec une passion pour l\'hôtellerie et la restauration, je suis déterminé à faire de notre établissement le meilleur de la ville. J\'admire énormément le travail d\'Émilie Dubois, notre talentueuse chef cuisto, dont les créations culinaires sont à tomber par terre. Son talent et sa créativité m\'inspirent au quotidien, et je suis honoré de travailler à ses côtés. Qui sait, peut-être que notre collaboration nous réserve plus que de délicieux plats...', 0),
(8, 'Anna', 'De Vries', 'anna.devries@moge-tee.com', '$2y$10$ULKqnKFrE8YgGFQM2Ddt9OqlGlkrLvRnLOVa7TPsE0VgCFxCdWbPq', '', 'bc89ed4bc8a2e46d7d6c0cd6ab950382-6637c240155cf.jpg', 'Bonjour à tous, je suis Anna De Vries et je suis ravie de rejoindre l\'équipe Moge-Tee à Gand en tant que serveuse. Avec une passion pour le service client et une attention aux détails, je suis déterminée à offrir à nos clients une expérience mémorable à chaque visite.', 0),
(9, 'Simon', 'Janssens', 'simon.janssens@moge-tee.com', '$2y$10$gGzeSU.yinVX4mEuLMWKuePmLTmpaY/Pe/p8nKhGg7q8il4bBEG/K', '04987654321', '5bf24b4236ff7a63d7ad676b6ca71ade-6637c3102b430.jpg', 'Salut tout le monde ! Je suis Simon Janssens et je suis ravi de rejoindre l\'équipe Moge-Tee à Gand en tant que serveur. Avec une expérience dans l\'hôtellerie et un engagement envers l\'excellence du service, je suis déterminé à faire de chaque repas chez Moge-Tee une expérience inoubliable pour nos clients. ', 0),
(10, 'Jeanne', 'Leclerc', 'jeanne.leclerc@moge-tee.com', '$2y$10$8OXGjNLhmlVxYlB8Ns1aC.aBbweB566Qdt71V/7OUya7wgBsf1TAm', '04234567890', 'da57e318745e8d7cc992da47b3649f2c-6637c43f1f31a.jpg', 'Bonjour à tous, je suis Jeanne Leclerc, le nouveau chef de cuisine chez Moge-Tee à Bruxelles. Avec une passion pour la gastronomie et une expérience diversifiée en cuisine, je suis déterminée à apporter des saveurs nouvelles et excitantes à notre menu. ', 0),
(11, 'Michel', 'Michel', 'michel.dubois@moge-tee.com', '$2y$10$e1KHeirmb3U.GHXYAJdwEOPgl2fL1QCxHBhSpU7dG5bSNFsEltv5i', '', '6378e17ad06fd3468d5e80a04a26715e-6637c4c4ee8a2.jpg', 'Salut à tous, je suis Michel Dubois, le technicien de surface de confiance de Moge-Tee à Bruxelles et Anvers. J\'aime manger beaucoup.', 0),
(12, 'Lucas', 'Jacobs', 'lucas.jacobs@moge-tee.com', '$2y$10$YuI1WHx6inUqq/Pm5w/tsOG47jtLoYwzo5o9b6wFehDB8h1vJBIo.', '', '94d17f9c330f216374c4325eb5e05f6f-6637c53d595a4.jpg', 'Bonjour à tous, je suis Lucas Jacobs et je suis ravi de rejoindre l\'équipe Moge-Tee à Anvers en tant que serveur. ', 0),
(13, 'Élise', 'Wouters', 'elise.wouters@moge-tee.com', '$2y$10$0dqPnstneyDRW5vaIpWgY.rIHdwOjiE0MSvWPhNqcb1vSUpOnuHrK', '', '23fdd10b3318cb5fba19ab47b6a36300-6637c58f78cdd.jpg', 'Salut tout le monde, je suis Élise Wouters, la nouvelle technicienne de surface chez Moge-Tee à Gand.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `staff_function`
--

CREATE TABLE `staff_function` (
  `fk_staff` int NOT NULL,
  `fk_department` int NOT NULL,
  `fk_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `staff_function`
--

INSERT INTO `staff_function` (`fk_staff`, `fk_department`, `fk_role`) VALUES
(2, 4, 2),
(3, 1, 3),
(3, 3, 3),
(4, 2, 5),
(4, 4, 5),
(5, 1, 1),
(6, 4, 4),
(7, 2, 3),
(8, 3, 1),
(9, 3, 1),
(10, 1, 5),
(12, 2, 1),
(13, 3, 4),
(11, 2, 4),
(11, 1, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actuality`
--
ALTER TABLE `actuality`
  ADD PRIMARY KEY (`id_actuality`),
  ADD KEY `fk_department` (`fk_department`);

--
-- Index pour la table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `staff_function`
--
ALTER TABLE `staff_function`
  ADD KEY `fk_staff` (`fk_staff`),
  ADD KEY `fk_department` (`fk_department`),
  ADD KEY `fk_role` (`fk_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actuality`
--
ALTER TABLE `actuality`
  MODIFY `id_actuality` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actuality`
--
ALTER TABLE `actuality`
  ADD CONSTRAINT `actuality_ibfk_1` FOREIGN KEY (`fk_department`) REFERENCES `department` (`id_department`) ON DELETE CASCADE;

--
-- Contraintes pour la table `staff_function`
--
ALTER TABLE `staff_function`
  ADD CONSTRAINT `staff_function_ibfk_1` FOREIGN KEY (`fk_staff`) REFERENCES `staff` (`id_staff`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_function_ibfk_2` FOREIGN KEY (`fk_department`) REFERENCES `department` (`id_department`) ON DELETE RESTRICT,
  ADD CONSTRAINT `staff_function_ibfk_3` FOREIGN KEY (`fk_role`) REFERENCES `role` (`id_role`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
