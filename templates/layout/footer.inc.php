<footer class="footer">
    <div class="container">
        <section class="left">
            <h3>Contactez-nous</h3>
            <p>
                Pour toutes vos questions, suggestions ou demandes d'information, envoyez-nous un e-mail à l'adresse
                ci-dessus. Nous sommes là pour vous aider !
                <br>
                <br>
                Email: Info@mogetee.nl
                <br>
                <br>
                Vous préférez utiliser un formulaire de contact ? Cliquez sur le bouton ci-dessous pour accéder à notre formulaire en ligne
            </p>
            <a href="index.php?action=contact" class="btn-yellow">Contact</a>
        </section>
        <section class="center">
            <img src="assets/images/logos/logo-no-background.webp" alt="logo">
        </section>
        <section class="right">
            <nav>
                <h3>Navigation</h3>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=actualites">Actualités</a></li>
                    <li><a href="index.php?action=consulter-equipe">Notre équipe</a></li>
                    <li><a href="index.php?action=contact">Contact</a></li>
                    <?php if (\src\core\Auth::isAdmin()): ?>
                        <li><a href="index.php?action=roles">Administration</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <hr>
            <section>
                <h3>Nos réseaux sociaux</h3>
                <section>
                    <a href="https://facebook.com"><img src="assets/images/icons/facebook.webp" alt="facebook"></a>
                    <a href="https://instagram.com"><img src="assets/images/icons/instagram.webp" alt="instagram"></a>
                </section>
            </section>
        </section>
        <section class="bottom">
           <p>© <?= date('Y') ?> Moge Tee</p>
        </section>
    </div>
</footer>
</body>
</html>