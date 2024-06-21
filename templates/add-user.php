<?php
require_once 'components/page-header.inc.php';
use src\models\function\RoleDepartment;
use src\libs\util\ArrayUtil;

if (isset($_GET['departments_roles'])){
    $_GET['departments_roles'] = unserialize($_GET['departments_roles']);
    if (!is_array($_GET['departments_roles'])){
        unset($_GET['departments_roles']);
    }
}
?>
<main>
    <div class="container dashed-border-lr">
        <section class="form-only">
            <section class="back-btn-container">
                <a href="index.php?action=consulter-equipe" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour à l'équipe
                </a>
            </section>
            <h2>Ajouter un membre</h2>
            <form method="post" enctype="multipart/form-data">
                <ul>
                    <li>
                        <label for="firstname">Prénom</label>
                        <input
                            type="text"
                            id="firstname"
                            name="firstname"
                            placeholder="Entrez le prénom..."
                            value="<?= htmlentities($_GET['firstname'] ?? '') ?>"
                            required>
                    </li>
                    <li>
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Entrez le nom..."
                               value="<?= htmlentities($_GET['lastname'] ?? '') ?>"
                               required>
                    </li>
                    <li>
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Entrez l'e-mail..."
                               value="<?= htmlentities($_GET['email'] ?? '') ?>"
                               required>
                    </li>
                    <li>
                        <label for="phone">Numéro de téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Entrez le numéro de téléphone..."
                               value="<?= htmlentities($_GET['phone'] ?? '') ?>">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="8" id="description" name="description"
                                  placeholder="Entrez la description..."><?= htmlentities($_GET['description'] ?? '') ?></textarea>
                    </li>
                    <li>
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Entrez le mot de passe..." required>
                    </li>
                    <li>
                        <label for="passwordRepetition">Répétition du mot de passe</label>
                        <input type="password" id="passwordRepetition" name="passwordRepetition" placeholder="Entrez la répétition du mot de passe..." required>
                    </li>
                    <li class="file">
                        <label for="image">Photo de profil</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </li>
                    <li>
                        <h3>Départements et rôles</h3>
                        <?php
                        /** @var \src\models\department\Department $department */
                        foreach ($data['departments'] as $department): ?>
                            <fieldset>
                                <legend><?= htmlentities($department->name) ?></legend>
                                <label>
                                    <input
                                        type="radio"
                                        name="departments_roles[<?= htmlentities($department->id_department) ?>]"
                                        value="-1"
                                        checked
                                    >
                                    Aucun
                                </label>
                                <?php
                                /** @var \src\models\role\Role $role */
                                foreach ($data['roles'] as $role): ?>
                                    <label>
                                        <input
                                            type="radio"
                                            name="departments_roles[<?= htmlentities($department->id_department) ?>]" value="<?=htmlentities($role->id_role) ?>"
                                            <?php
                                            if (
                                                    isset($_GET['departments_roles']) &&
                                                    isset($_GET['departments_roles'][$department->id_department]) &&
                                                    intval($_GET['departments_roles'][$department->id_department]) === $role->id_role
                                            )
                                            {
                                                echo 'checked';
                                            }
                                            ?>
                                        >
                                        <?= htmlentities($role->name) ?>
                                    </label>
                                <?php endforeach; ?>
                            </fieldset>
                        <?php endforeach; ?>
                    </li>
                    <li>
                        <button type="submit" class="btn-yellow">Ajouter</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</main>

