<?php
require_once 'components/page-header.inc.php';
use src\models\function\RoleDepartment;
use src\libs\util\ArrayUtil;
/** @var \src\models\staff\Staff $staff */
$staff = $data['staff'];
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
                <a href="index.php?action=consulter-equipe&staffID=<?= htmlentities($staff->id_staff) ?>" class="back-btn btn-yellow">
                    <img src="assets/images/icons/back.svg" alt="retour icon">
                    Retour au profil
                </a>
            </section>
            <h2>Éditer le profil</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="staffID" value="<?= htmlentities($staff->id_staff) ?>">
                <ul>
                    <li>
                        <label for="firstname">Prénom</label>
                        <input
                                type="text"
                                id="firstname"
                                name="firstname"
                                placeholder="Entrez le prénom..."
                                value="<?= htmlentities($_GET['firstname'] ?? $staff->firstname) ?>"
                                required>
                    </li>
                    <li>
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Entrez le nom..."
                               value="<?= htmlentities($_GET['lastname'] ?? $staff->lastname) ?>"
                               required>
                    </li>
                    <li>
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Entrez l'e-mail..."
                               value="<?= htmlentities($_GET['email'] ?? $staff->email) ?>"
                               required>
                    </li>
                    <li>
                        <label for="phone">Numéro de téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Entrez le numéro de téléphone..."
                               value="<?= htmlentities($_GET['phone'] ?? $staff->phone_number) ?>">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="8" id="description" name="description"
                                  placeholder="Entrez la description..."><?= htmlentities($_GET['description'] ?? $staff->description) ?></textarea>
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
                                /** @var \src\models\role\Role $roleId */
                                foreach ($data['roles'] as $roleId): ?>
                                    <label>
                                        <input
                                                type="radio"
                                                name="departments_roles[<?= htmlentities($department->id_department) ?>]" value="<?= htmlentities($roleId->id_role) ?>"
                                            <?php
                                                if (
                                                    (isset($_GET['departments_roles']) &&
                                                    isset($_GET['departments_roles'][$department->id_department]) &&
                                                    intval($_GET['departments_roles'][$department->id_department]) === $roleId->id_role) ||
                                                    ArrayUtil::any($data['staffRoles'], function($staffRole) use ($department, $roleId){
                                                        /** @var \src\models\function\RoleDepartment $staffRole */
                                                        return $staffRole->isEqual($roleId->name, $department->name);
                                                    })
                                                )
                                                {
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <?= htmlentities($roleId->name) ?>
                                    </label>
                                <?php endforeach; ?>
                            </fieldset>
                        <?php endforeach; ?>
                    </li>
                    <li>
                        <button type="submit" class="btn-yellow">Éditer</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</main>

