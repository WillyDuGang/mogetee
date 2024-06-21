<?php
require_once 'components/page-header.inc.php';
use src\core\Auth;
?>
<main>
    <div class="container dashed-border-lr">
        <section class="image-form">
            <div class="left">
                <img src="assets/images/content/contact-1.webp" alt="contact">
            </div>
            <div class="right">
                <h2>Contactez-nous !</h2>
                <form method="post">
                    <label class="info"><span></span><input type="text" name="info" value=""/></label>
                    <ul>
                        <li>
                            <label for="email">E-mail</label>
                            <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Entrez votre E-mail..."
                                    value="<?= htmlentities($_GET['email'] ?? Auth::getStaff()?->email) ?>"
                                    required
                            >
                        </li>
                        <li>
                            <label for="subject">Objet</label>
                            <input type="text" id="subject" name="subject" placeholder="Entrez un objet..." required>
                        </li>
                        <li>
                            <label for="message">Message</label>
                            <textarea rows="4" id="message" name="message"
                                      placeholder="Entrez un message..." required></textarea>
                        </li>
                        <li>
                            <button type="submit" class="btn-yellow">Envoyer</button>
                        </li>
                    </ul>

                </form>
            </div>
        </section>
    </div>
</main>
