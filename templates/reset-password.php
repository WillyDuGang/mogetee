<?php require_once 'components/page-header.inc.php' ?>
<main>
    <div class="container dashed-border-lr forget-password-container">
        <section class="image-form">
            <div class="left">
                <img src="assets/images/content/forget-password-1.webp" alt="mot de passe oublié">
            </div>
            <div class="right">
                <h2>Mot de passe oublié ?</h2>
                <div class="form-list">
                    <form method="post" id="reset-password">
                        <input type="hidden" name="_method" value="PATCH">
                        <ul>
                            <li>
                                <label for="email">E-mail</label>
                                <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        placeholder="Entrez votre E-mail..."
                                        value="<?= htmlentities($_GET['email'] ?? null) ?>"
                                        required>
                            </li>
                            <li class="form-link">
                                <a href="index.php?action=connexion">Connectez-vous ici</a>
                            </li>
                        </ul>
                    </form>
                    <form class="dialog-container">
                        <input type="checkbox" id="dialogToggle" class="dialog-toggle">
                        <section class="dialog">
                            <section class="overlay"></section>
                            <input type="reset" value="Annuler" class="btn-red"/>
                            <button type="submit" class="btn-green" form="reset-password">Confirmer</button>
                        </section>
                        <label class="dialog-btn btn-yellow" for="dialogToggle">Réinitialiser</label>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

