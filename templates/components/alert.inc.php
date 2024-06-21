<aside class="alert">
    <ul>
        <?php
        $type = $data['isError'] ? 'error' : 'success';
        $messagesCount = count($data['messages']);
        foreach ($data['messages'] as $index => $content): ?>
            <li class="<?= htmlentities($type) ?>" style="animation-delay: calc(<?= htmlentities(strval($messagesCount - $index)) ?> * 5s);">
                <img src="assets/images/icons/<?= htmlentities($type) ?>.svg" alt="<?= $data['isError'] ? 'erreur' : 'succès'?>">
                <p><?= htmlentities($content) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>


