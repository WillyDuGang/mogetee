<?php

namespace src\libs\middleware;

use src\core\Auth;
use src\core\View;

class GuestMiddleware implements Middleware
{

    public function before(): void
    {
        if (Auth::isAuth()){
            View::redirect(
                'accueil',
                ['Vous êtes déjà connecté.']
            )->goTo();
        }
    }
}