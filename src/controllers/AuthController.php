<?php

namespace src\controllers;

use src\core\Auth;
use src\core\View;
use src\libs\dto\LoginDto;
use src\libs\redirect\Redirect;
use src\models\staff\StaffRepository;

class AuthController extends Controller
{
    public function get(): void
    {
        $this->setTitle('Connexion');
        $this->renderPage('login', [
            'page-title' => 'Connexion',
            'bgImage' => 'assets/images/backgrounds/login-background-1.webp'
        ]);
    }

    public function post(): void
    {
        $loginDto = new LoginDto($_POST);
        $redirect = View::redirect();

        if (!$loginDto->isValidDto()){
            $redirect->goToError($loginDto->getErrors(), ['email' => $loginDto->get('email')]);
        }

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffByEmail($loginDto->get('email'), true);

        if (!$staff){
            $redirect->goToError(
                ["Il n'y pas de compte correspondant à l'adresse e-mail: " . $loginDto->get('email') . "."],
                ['email' => $loginDto->get('email')]
            );
        }

        if (!password_verify($loginDto->get('password'), $staff->password_hash)){
            $redirect->goToError(
                ["Le mot de passe est incorrect."],
                ['email' => $loginDto->get('email')]
            );
        }

        Auth::setSession($staff->toStaff());
        $redirect->setLocation('accueil');
        $redirect->addMessage('Vous avez réussi à vous connecter avec succès.');
        $redirect->goTo();
    }

    public function del(): void
    {
        Auth::removeSession();
        View::redirect('accueil', ['Vous êtes maintenant déconnecté.'])->goTo();
    }
}