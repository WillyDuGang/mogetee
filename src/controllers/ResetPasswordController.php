<?php

namespace src\controllers;

use src\core\Auth;
use src\core\View;
use src\libs\dto\ResetPasswordDto;
use src\libs\mail\MailManager;
use src\libs\util\Random;
use src\models\staff\StaffRepository;

class ResetPasswordController extends Controller
{

    public function get(): void
    {
        $this->setTitle('Mot de passe oublié');
        $this->renderPage('reset-password', [
            'page-title' => 'Réinitialisez votre mot de passe',
            'bgImage' => 'assets/images/backgrounds/forgot-password-background-1.webp'
        ]);
    }

    public function patch(): void
    {
        $resetPasswordDto = new ResetPasswordDto($_POST);
        $redirect = View::redirect();

        if (!$resetPasswordDto->isValidDto()){
            $redirect->goToError($resetPasswordDto->getErrors(), ['email' => $resetPasswordDto->get('email')]);
        }

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffByEmail($resetPasswordDto->get('email'));

        if (!$staff){
            $redirect->goToError(
                ["Il n'y pas de compte correspondant à l'adresse e-mail: " . $resetPasswordDto->get('email') . "."],
                ['email' => $resetPasswordDto->get('email')]
            );
        }

        $newPassword = Random::generateRandomString();
        $isUpdate = $staffRepository->updateStaffPasswordByEmail($resetPasswordDto->get('email'), $newPassword);
        if ($isUpdate){
            MailManager::sendMail(
                $resetPasswordDto->get('email'),
                'Réinitialisation de votre mot de passe',
                'reset-password',
                [
                    'firstname' => ucfirst($staff->firstname),
                    'lastname' => ucfirst($staff->lastname),
                    'password' => $newPassword
                ]
            );
            $redirect->setLocation('connexion');
            $redirect->addMessage('Vous pouvez maintenant vous connecter.');
            $redirect->addMessage('Nouveau mot de passe envoyé par e-mail.');
            $redirect->addMessage('Mot de passe réinitialisé avec succès.');
            $redirect->addParam('email', $resetPasswordDto->get('email'));
            $redirect->goTo();
        } else {
            $redirect->goToError(
                ["Une erreur est survenue. Le mot de passe n'a pas pu être réinitialisé."],
                ['email' => $resetPasswordDto->get('email')]
            );
        }
    }


}