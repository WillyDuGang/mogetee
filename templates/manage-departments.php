<?php require_once 'components/page-header.inc.php' ?>
<main>
    <div class="container dashed-border-lr administration-container">
        <section>
            <nav>
                <ul>
                    <li><h2>Gestion:</h2> </li>
                    <li><a href="index.php?action=roles">Rôles</a></li>
                    <li><a href="index.php?action=departments">Départments</a></li>
                </ul>
            </nav>
            <section>
                <h2>Ajouter un département</h2>
                <section class="form add-form">
                    <form method="post">
                        <ul>
                            <li>
                                <label for="new-department">
                                    <img src="assets/images/icons/add.svg" alt="ajouter departement">
                                    Ajouter un département
                                </label>
                                <input type="text" id="new-department" name="name" placeholder="Entrez le nom du département..." required>
                            </li>
                            <li>
                                <button type="submit" class="btn-yellow">Ajouter</button>
                            </li>
                        </ul>
                    </form>
                </section>
                <h2>Liste des départements</h2>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Modifier le nom</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                    /** @var \src\models\department\Department $department*/
                    foreach ($data['departments'] as $department): ?>
                        <tr>
                            <td><?= htmlentities($department->name) ?></td>
                            <td class="form">
                                <form method="post">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="departmentID" value="<?= htmlentities($department->id_department) ?>">
                                    <ul>
                                        <li>
                                            <label for="<?= htmlentities($department->id_department) ?>">
                                                <input
                                                    type="text"
                                                    id="<?= htmlentities($department->id_department) ?>"
                                                    name="name"
                                                    placeholder="Entrez le nouveau nom du départements"
                                                    value="<?= htmlentities($department->name) ?>"
                                                    required
                                                >
                                            </label>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn-yellow">Modifier</button>
                                        </li>
                                    </ul>
                                </form>
                            </td>
                            <td class="delete">
                                <form class="dialog-container">
                                    <input type="checkbox" id="dialogToggle<?=htmlentities($department->id_department) ?>" class="dialog-toggle">
                                    <section class="dialog">
                                        <input type="reset" value="Annuler" class="btn-red"/>
                                        <a
                                            href="index.php?action=departments&departmentID=<?= htmlentities($department->id_department) ?>&_method=DELETE"
                                            class="btn-green"
                                        >
                                            Confirmer
                                        </a>
                                    </section>
                                    <label class="dialog-btn link-orange" for="dialogToggle<?= htmlentities($department->id_department) ?>">
                                        <img src="assets/images/icons/trash.svg" alt="supprimer">
                                        Supprimer
                                    </label>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
        </section>
    </div>
</main>

