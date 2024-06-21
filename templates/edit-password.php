<?php
require_once 'components/page-header.inc.php';
/** @var \src\models\staff\Staff $staff */
$staff = $data['staff'];
?>
<main>
    <div class="container dashed-border-lr">
        <section class="form-only">
            <section class="back-btn-container">
                <a href="index.php?action=consulter-equipe&staffID=<?= htmlentities($staff->id_staff) ?>" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour au profil
                </a>
            </section>
            <h2>Changer le mot de passe</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="staffID" value="<?= htmlentities($staff->id_staff) ?>">
                <ul>
                    <li>
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Entrez le mot de passe..." required>
                    </li>
                    <li>
                        <label for="passwordRepetition">Répétition du mot de passe</label>
                        <input type="password" id="passwordRepetition" name="passwordRepetition" placeholder="Entrez la répétition du mot de passe..." required>
                    </li>
                    <li>
                        <button type="submit" class="btn-yellow">Changer</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</main>

