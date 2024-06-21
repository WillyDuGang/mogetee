<?php
require_once 'components/page-header.inc.php';
/** @var \src\models\actuality\FullActuality $actuality */
$actuality = $data['actuality'];
?>

<main class="news-main">
    <div class="container dashed-border-lr">
        <section class="new-section">
            <section class="back-btn-container" >
                <a href="index.php?action=actualites" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour aux actualités
                </a>
            </section>
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

            <section class="new-body">
                <?php if(\src\core\Auth::isAuth()): ?>

                    <section class="link-container">
                        <a href="index.php?action=editer-actualite&actualityID=<?= htmlentities($actuality->id_actuality) ?>">
                            <img src="assets/images/icons/edit.svg" alt="éditer">
                            Éditer
                        </a>
                        <form class="dialog-container">
                            <input type="checkbox" id="dialogToggle" class="dialog-toggle">
                            <section class="dialog">
                                <input type="reset" value="Annuler" class="btn-red"/>
                                <a
                                        href="index.php?action=editer-actualite&actualityID=<?= htmlentities($actuality->id_actuality) ?>&_method=DELETE"
                                        class="btn-green"
                                >

                                    Confirmer
                                </a>
                            </section>
                            <label class="dialog-btn" for="dialogToggle">
                                <img src="assets/images/icons/trash.svg" alt="supprimer">
                                Supprimer
                            </label>
                        </form>
                    </section>
                <?php endif; ?>
                <?php if ($actuality->department !== null): ?>
                    <aside><?= htmlentities($actuality->department) ?></aside>
                <?php endif;?>
                <h2><?= htmlentities($actuality->subject) ?></h2>
                <h3><?= htmlentities($actuality->introduction) ?></h3>
                <section class="body"><?= $actuality->body ?>
                </section>
            </section>
        </section>
        <?php require_once 'components/actuality-aside.inc.php'; ?>
    </div>
</main>