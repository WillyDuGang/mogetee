<?php

namespace src\libs\middleware;

use src\core\Auth;
use src\core\View;

class AuthMiddleware implements Middleware
{

    public function before(): void
    {
        if (!Auth::isAuth()){
            View::redirect(
                'connexion',
                ['Authentification requise. Connectez-vous pour accéder à cette page.'],
                true
            )->goTo();
        }
    }
}