<?php require_once 'components/page-header.inc.php' ?>

<main class="news-main">
    <div class="container dashed-border-lr">
        <?php if (empty($data['actualities'])): ?>
            <section class="empty-news">
                <h2>Oops! Aucune actualité trouvée. Veuillez réessayer avec d'autres filtres.</h2>
                <img src="assets/images/content/panda-1.webp" alt="panda perdu">
            </section>
        <?php else: ?>
            <section class="new-list">
                <?php
                foreach ($data['actualities'] as $actuality) {
                    require 'components/actuality-article.inc.php';
                }
                ?>
            </section>
        <?php endif; ?>
        <?php require_once 'components/actuality-aside.inc.php'; ?>
    </div>
</main>

