<?php

namespace src\libs\middleware;

use src\core\Auth;
use src\core\View;

class AdminMiddleware implements Middleware
{

    public function before(): void
    {
        if (!Auth::isAdmin()){
            View::redirect(
                'accueil',
                ["Accès refusé : Vous n'êtes pas autorisé à accéder à cette page car vous n'êtes pas un administrateur"],
                true
            )->goTo();
        }
    }
}