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
                <h2>Ajouter un rôle</h2>
                <section class="form add-form">
                    <form method="post">
                        <ul>
                            <li>
                                <label for="new-role">
                                    <img src="assets/images/icons/add.svg" alt="ajouter role">
                                    Ajouter un rôle
                                </label>
                                <input type="text" id="new-role" name="name" placeholder="Entrez le nom du rôle..." required>
                            </li>
                            <li>
                                <button type="submit" class="btn-yellow">Ajouter</button>
                            </li>
                        </ul>
                    </form>
                </section>
                <h2>Liste des rôles</h2>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Modifier le nom</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                        /** @var \src\models\role\Role $role*/
                        foreach ($data['roles'] as $role): ?>
                            <tr>
                                <td><?= htmlentities($role->name) ?></td>
                                <td class="form">
                                    <form method="post">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="roleID" value="<?= htmlentities($role->id_role) ?>">
                                        <ul>
                                            <li>
                                                <label for="<?= htmlentities($role->id_role) ?>">
                                                    <input
                                                            type="text"
                                                            id="<?= htmlentities($role->id_role) ?>"
                                                            name="name"
                                                            placeholder="Entrez le nouveau nom du rôle"
                                                            value="<?= htmlentities($role->name) ?>"
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
                                        <input type="checkbox" id="dialogToggle<?=htmlentities($role->id_role) ?>" class="dialog-toggle">
                                        <section class="dialog">
                                            <input type="reset" value="Annuler" class="btn-red"/>
                                            <a
                                                    href="index.php?action=roles&roleID=<?= htmlentities($role->id_role) ?>&_method=DELETE"
                                                    class="btn-green"
                                            >
                                                Confirmer
                                            </a>
                                        </section>
                                        <label class="dialog-btn link-orange" for="dialogToggle<?= htmlentities($role->id_role) ?>">
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

