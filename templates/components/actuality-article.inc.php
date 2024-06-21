<?php
/** @var $actuality \src\models\actuality\LightActuality */ ?>
<article>
    <header>
        <aside class="new-aside">
            <ul>

                <?php if (\src\core\Auth::isAuth() && !$actuality->is_visible): ?>
                    <li class="not-visible">
                        Non visible
                    </li>
                <?php endif; ?>
                <li class="createdAt">
                    <?= htmlentities($actuality->getDate()) ?>
                </li>
            </ul>
        </aside>
        <img src="<?= htmlentities($actuality->getImageUrl()) ?>" alt="image de l'article">
    </header>
    <section>
        <header>
            <h3>
                <a href="index.php?action=actualites&actualityID=<?= htmlentities($actuality->id_actuality) ?>" class="link-orange">
                    <?= htmlentities($actuality->subject) ?>
                </a>
            </h3>
        </header>
        <p>
            <?= htmlentities($actuality->introduction) ?>
        </p>
        <footer class="link-container">
            <a href="index.php?action=actualites&actualityID=<?= htmlentities($actuality->id_actuality) ?>">
                <img src="assets/images/icons/binoculars.svg" alt="voir">
                Lire plus...
            </a>
            <?php if(\src\core\Auth::isAuth()): ?>

                <a href="index.php?action=editer-actualite&actualityID=<?= htmlentities($actuality->id_actuality) ?>">
                    <img src="assets/images/icons/edit.svg" alt="éditer">
                    Éditer
                </a>

                <form class="dialog-container actuality-article-dialog">
                    <input type="checkbox" id="dialogToggle<?=htmlentities($actuality->id_actuality) ?>" class="dialog-toggle">
                    <section class="dialog">
                        <input type="reset" value="Annuler" class="btn-red"/>
                        <a
                                href="index.php?action=editer-actualite&actualityID=<?= htmlentities($actuality->id_actuality) ?>&_method=DELETE"
                                class="btn-green"
                        >
                            Confirmer
                        </a>
                    </section>
                    <label class="dialog-btn" for="dialogToggle<?=htmlentities($actuality->id_actuality) ?>">
                        <img src="assets/images/icons/trash.svg" alt="supprimer">
                        Supprimer
                    </label>
                </form>
            <?php endif; ?>
        </footer>
    </section>
</article>