<?php require_once 'components/page-header.inc.php' ?>
<main>
    <div class="container dashed-border-lr">
        <section class="image-form">
            <div class="left">
                <img src="assets/images/content/login-1.webp" alt="connexion">
            </div>
            <div class="right">
                <h2>Connectez-vous !</h2>
                <form method="post">
                    <ul>
                        <li>
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="Entrez votre E-mail..." value="<?= htmlentities($_GET['email'] ?? null)?>" required>
                        </li>
                        <li>
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." required>
                        </li>
                        <li class="form-link">
                            <a href="index.php?action=reinitialiser-mot-de-passe">Réinitialisez votre mot de passe ici</a>
                        </li>
                        <li>
                            <button type="submit" class="btn-yellow">Connexion</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
    </div>
</main>

