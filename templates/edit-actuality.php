<?php
require_once 'components/page-header.inc.php';
/** @var \src\models\actuality\FullActuality $actuality */
$actuality = $data['actuality'];
?>
<main>
    <div class="container dashed-border-lr">
        <section class="form-only">
            <section class="back-btn-container">
                <a href="index.php?action=actualites&actualityID=<?= htmlentities($actuality->id_actuality) ?>" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour sur l'actualité
                </a>
            </section>
            <h2>Éditez votre actualité</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="actualityID" value="<?= htmlentities($actuality->id_actuality) ?>">
                <ul>
                    <li>
                        <label for="date">Date</label>
                        <input
                                type="date"
                                id="date"
                                name="date"
                                value="<?= htmlentities($_GET['date'] ?? $actuality->date) ?>"
                                required>
                    </li>
                    <li>
                        <label for="subject">Intitulé</label>
                        <input
                                type="text"
                                id="subject"
                                name="subject"
                                placeholder="Entrez l'intitulé..."
                                value="<?= htmlentities($_GET['subject'] ?? $actuality->subject) ?>"
                                required>
                    </li>
                    <li class="file">
                        <label for="image">Image d’aperçu</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </li>
                    <li>
                        <label for="introduction">Texte d’amorce</label>
                        <input type="text" id="introduction" name="introduction"
                               placeholder="Entrez le texte d'amorce..."
                               value="<?= htmlentities($_GET['introduction'] ?? $actuality->introduction) ?>"
                               required>
                    </li>
                    <li>
                        <label for="body">Texte complet</label>
                        <textarea rows="8" id="body" name="body"
                                  placeholder="Entrez le texte complet..." required><?= htmlentities($_GET['body'] ?? $actuality->body) ?>
                        </textarea>
                    </li>
                    <li>
                        <label for="department">Département</label> <br>
                        <select id="department" name="department" required>
                            <option value="-1" <?php
                                if (isset($_GET['department'])){
                                    if (intval($_GET['department']) === -1){
                                        echo 'selected';
                                    }
                                } elseif($actuality->department === null){
                                        echo 'selected';
                                }
                            ?> >Aucun</option>
                            <?php
                            /** @var \src\models\department\Department $department */
                            foreach ($data['departments'] as $department): ?>
                                <option
                                        value="<?= htmlentities($department->id_department) ?>"
                                    <?php
                                    if (isset($_GET['department'])){
                                        if (intval($_GET['department']) === $department->id_department){
                                            echo 'selected';
                                        }
                                    } elseif($actuality->department === $department->name){
                                        echo 'selected';
                                    }
                                    ?>
                                ><?= htmlentities($department->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="checkbox">
                        <input type="checkbox" id="isVisible" name="isVisible" <?= ($_GET['isVisible'] ?? $actuality->is_visible) ? 'checked' : ''?>>
                        <label for="isVisible">Visible</label>
                    </li>
                    <li>
                        <button type="submit" class="btn-yellow">Éditer</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</main>

