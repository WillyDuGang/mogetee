<?php
use src\core\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlentities($data['title']) ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
</head>

<body>
<header class="header">
    <div class="container">
        <a href="index.php">
            <img src="assets/images/logos/logo-no-background.webp" alt="logo">
            <h2>Moge Tee</h2>
        </a>
        <form action="index.php?action=actualites" class="search-bar" method="post">
            <label for="search" style="display: none"></label>
            <input id="search" type="text" placeholder="Recherche d'actualités par mots-clés..." name="keywords">
            <button type="submit" class="search-icon"></button>
        </form>
        <?php if ($staff = Auth::getStaff()): ?>
        <section class="dropdown">
            <button class="dropdown-toggle">
                <?= htmlentities($staff->firstname) ?> <?= htmlentities($staff->lastname) ?>
                <img src="<?= htmlentities($staff->getProfilPictureUrl()) ?>" alt="photo de profil">
            </button>
            <ul class="dropdown-menu">
                <li><a href="index.php?action=consulter-equipe&staffID=<?= htmlentities($staff->id_staff) ?>">Mon profil</a></li>
                <li><a href="index.php?action=editer-profil">Editer mon profil</a></li>
                <li><a href="index.php?action=changer-mot-de-passe">Changer mon mot de passe</a></li>
                <li><a href="index.php?action=deconnexion&_method=DELETE">Deconnexion</a></li>
            </ul>
        </section>
        <?php else: ?>
            <a href="index.php?action=connexion">
                Connexion
            </a>
        <?php endif ?>
    </div>
</header>
<nav class="nav-bar">
    <div class="container">
        <ul>
            <li><a href="index.php" class="navLinkActive">Accueil</a></li>
            <li><a href="index.php?action=actualites">Actualités</a></li>
            <li><a href="index.php?action=consulter-equipe">Notre équipe</a></li>
            <li><a href="index.php?action=contact">Contact</a></li>
            <?php if (Auth::isAdmin()): ?>
                <li><a href="index.php?action=roles">Administration</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>