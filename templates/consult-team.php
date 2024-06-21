<?php

use src\models\function\StaffFunction;

require_once 'components/page-header.inc.php';
?>
<main class="consult-team-main">
    <div class="container dashed-border-lr">
        <?php if (\src\core\Auth::isAdmin()): ?>
            <header>
                <a href="index.php?action=ajouter-membre" class="link-orange">
                    <img src="assets/images/icons/add.svg" alt="Ajouter un membre">
                    Ajouter un membre
                </a>
            </header>
        <?php endif; ?>

        <?php
        foreach ($data['staffs'] as $department => $staffs): ?>
            <section class="department-section">
                <header class="department-section-header">
                    <img src="assets/images/icons/location.svg" alt="département">
                    <h2><?= empty($department) ? 'Sans département' : htmlentities($department) ?></h2>
                </header>
                <section class="employee-list">
                    <?php /** @var StaffFunction $staff */
                    foreach ($staffs as $staff): ?>
                        <article>
                            <header>
                                <img src="<?= htmlentities($staff->getProfilPictureUrl()) ?>" alt="photo de profil">
                            </header>
                            <section>
                                <h5><a href="index.php?action=consulter-equipe&staffID=<?= htmlentities($staff->id_staff) ?>"
                                       class="link-orange"><?= htmlentities($staff->firstname) ?> <?= htmlentities($staff->lastname) ?></a></h5>
                                <p><?= htmlentities($staff->role ?? 'Pas de rôle') ?></p>
                                <a href="index.php?action=consulter-equipe&staffID=<?= htmlentities($staff->id_staff) ?>"
                                   class="link-orange">Voir plus</a>
                            </section>
                        </article>
                    <?php endforeach; ?>
                </section>
            </section>
        <?php endforeach; ?>
    </div>
</main>
