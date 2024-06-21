<?php
use src\libs\cookie\ActualityFilter;
?>
<aside class="news-aside">
    <?php if(\src\core\Auth::isAuth()): ?>
        <section>
            <a href="index.php?action=editer-actualite" class="btn-white">
                <img src="assets/images/icons/add.svg" alt="ajouter">
                Créer une actualité
            </a>
        </section>
    <?php endif; ?>
    <form  method="post" class="filter-form">
        <ul>
            <li>
                <label class="search-bar">
                    <input
                            type="text"
                            placeholder="Recherche d'actualités par mots-clés..."
                            name="keywords"
                            value="<?= htmlentities(ActualityFilter::getFilter(ActualityFilter::KEYWORDS)) ?>"
                    >
                </label>
            </li>
            <li class="department-field">
                <header>
                    <img src="assets/images/icons/location.svg" alt="département">
                    <h4>Départements</h4>
                </header>
                <ul class="department-list">
                    <?php
                        $departmentId = ActualityFilter::getFilter(ActualityFilter::DEPARTMENT);
                        if ($departmentId !== null){
                            $departmentId = intval($departmentId);
                        }
                    ?>
                    <li>
                        <input
                                type="radio"
                                id="department--1"
                                name="department"
                                value="-1"
                            <?= $departmentId === null ? 'checked' : '' ?>
                        >
                        <label for="department--1">Tous</label>
                    </li>
                    <?php
                    /** @var \src\models\department\Department $department */
                    foreach ($data['departments'] as $department): ?>
                        <li>
                            <input
                                    type="radio"
                                    id="department-<?= htmlentities($department->id_department) ?>"
                                    name="department"
                                    value="<?= htmlentities($department->id_department) ?>"
                                    <?= $departmentId === $department->id_department ? 'checked' : '' ?>
                            >
                            <label for="department-<?= htmlentities($department->id_department) ?>"><?= htmlentities($department->name) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="submit-field">
                <button type="submit" class="btn-white">
                    Envoyer les filtres
                    <img src="assets/images/icons/search.svg" alt="rechercher">
                </button>
            </li>
        </ul>
    </form>
</aside>