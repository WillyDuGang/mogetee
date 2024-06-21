<?php
use src\models\function\RoleDepartment;
use src\models\staff\Staff;

require_once 'components/page-header.inc.php';
use src\core\Auth;

/** @var Staff $staff */
$staff = $data['staff'];
/** @var RoleDepartment[] $allRoleDepartment */
$allRoleDepartment = $data['allRoleDepartment'];
?>

<main class="consult-staff-main">
    <div class="container dashed-border-lr">
        <section class="back-btn-container">
            <a href="index.php?action=consulter-equipe" class="back-btn btn-yellow">
                <img src="assets/images/icons/back.svg" alt="retour icon">
                Retour à l'équipe
            </a>
        </section>
        <section>
            <div class="left">
                <img src="<?= htmlentities($staff->getProfilPictureUrl()) ?>" alt="photo de profil">
            </div>
            <div class="right">

                <h2><?= htmlentities($staff->firstname) ?> <?= htmlentities($staff->lastname) ?></h2>
                <ul>
                    <li>
                    <?php if ($staff->id_staff === Auth::getStaff()?->id_staff || \src\core\Auth::isAdmin()): ?>

                            <a
                                    href="index.php?action=editer-profil<?= $staff->id_staff !== Auth::getStaff()->id_staff ? htmlentities('&staffID='.$staff->id_staff) : ''?>"
                                    class="link-orange"
                            >
                                <img src="assets/images/icons/edit.svg" alt="éditer">
                                Éditer le profil
                            </a>
                            <a
                                    href="index.php?action=changer-mot-de-passe<?= $staff->id_staff !== Auth::getStaff()->id_staff ? htmlentities('&staffID='.$staff->id_staff) : ''?>"
                                    class="link-orange"
                            >
                                <img src="assets/images/icons/change-password.svg" alt="changer mot de passe">
                                Changer le mot de passe
                            </a>
                    <?php endif; ?>
                        <?php if (Auth::isAdmin() && $staff->id_staff !== Auth::getStaff()?->id_staff): ?>
                            <form class="dialog-container actuality-article-dialog">
                                <input type="checkbox" id="dialogToggle" class="dialog-toggle">
                                <section class="dialog">
                                    <input type="reset" value="Annuler" class="btn-red"/>


                                    <a
                                            href="index.php?action=supprimer-membre&staffID=<?= htmlentities($staff->id_staff) ?>&_method=DELETE"
                                            class="btn-green"
                                    >
                                        Supprimer
                                    </a>
                                </section>
                                <label class="dialog-btn link-orange" for="dialogToggle">
                                    <img src="assets/images/icons/trash.svg" alt="supprimer">
                                    Supprimer ce membre
                                </label>
                            </form>
                        <?php endif; ?>
                    </li>
                    <li>
                        <header>
                            <img src="assets/images/icons/email.svg" alt="email icon">
                            <h3>Email</h3>
                        </header>
                        <a href="mailto:<?= htmlentities($staff->email) ?>"><?= htmlentities($staff->email) ?></a>
                    </li>
                    <?php if ($staff->phone_number): ?>
                        <li>
                            <header>
                                <img src="assets/images/icons/phone-number.svg" alt="téléphone icon">
                                <h3>
                                    Téléphone
                                </h3>
                            </header>
                             <a href="tel:<?= htmlentities($staff->phone_number) ?>"><?= htmlentities($staff->phone_number) ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($allRoleDepartment)): ?>
                        <li>
                            <header>
                                <img src="assets/images/icons/location.svg" alt="départements">
                                <h3>
                                    Départements et rôles
                                </h3>
                            </header>
                            <ul>
                            <?php foreach ($allRoleDepartment as $roleDepartment): ?>
                                    <li>
                                        <?= htmlentities($roleDepartment->department) ?> - <?= htmlentities($roleDepartment->role) ?>
                                    </li>
                            <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li>
                        <header>
                            <img src="assets/images/icons/description.svg" alt="description icon">
                            <h3>Description</h3>
                        </header>
                        <p class="description"><?= empty($staff->description) ? 'Aucune description disponible.' : htmlentities($staff->description)?>
                        </p>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</main>
