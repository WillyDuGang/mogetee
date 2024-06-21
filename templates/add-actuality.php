<?php require_once 'components/page-header.inc.php' ?>
<main>
    <div class="container dashed-border-lr">
        <section class="form-only">
            <section class="back-btn-container">
                <a href="index.php?action=actualites" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour aux actualités
                </a>
            </section>
            <h2>Créez votre actualité</h2>
            <form method="post" enctype="multipart/form-data">
                <ul>
                    <li>
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" value="<?= htmlentities(date('Y-m-d')) ?>" required>
                    </li>
                    <li>
                        <label for="subject">Intitulé</label>
                        <input type="text" id="subject" name="subject" placeholder="Entrez l'intitulé..." required>
                    </li>
                    <li class="file">
                        <label for="image">Image d’aperçu</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </li>
                    <li>
                        <label for="introduction">Texte d’amorce</label>
                        <input type="text" id="introduction" name="introduction"
                               placeholder="Entrez le texte d'amorce..." required>
                    </li>
                    <li>
                        <label for="body">Texte complet</label>
                        <textarea rows="8" id="body" name="body"
                                  placeholder="Entrez le texte complet..." required></textarea>
                    </li>
                    <li>
                        <label for="department">Département</label> <br>
                        <select id="department" name="department" required>
                            <option value="-1" selected>Aucun</option>
                            <?php
                            /** @var \src\models\department\Department $department */
                            foreach ($data['departments'] as $department): ?>
                                <option value="<?= htmlentities($department->id_department) ?>"><?= htmlentities($department->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="checkbox">
                        <input type="checkbox" id="isVisible" name="isVisible" checked>
                        <label for="isVisible">Visible</label>
                    </li>
                    <li>
                        <button type="submit" class="btn-yellow">Créer</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</main>

