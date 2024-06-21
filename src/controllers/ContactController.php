<?php

namespace src\controllers;

use src\core\View;
use src\libs\dto\ContactDto;
use src\libs\mail\MailManager;
use src\libs\redirect\Redirect;

class ContactController extends Controller
{

    public function get(): void
    {
        $this->setTitle('Contact');
        $this->renderPage('contact', [
            'page-title' => 'Contact',
            'bgImage' => 'assets/images/backgrounds/contact-background-1.jpg'
        ]);
    }

    public function post(): void
    {
        $contactDto = new ContactDto($_POST);
        $redirect = View::redirect();
        if (!empty($_POST['info'])) {
            $redirect->goToError(["Requête refusée: trop d'infos !"]);
        }
        if (!$contactDto->isValidDto()){
            $redirect->goToError($contactDto->getErrors(), ['email' => $contactDto->get('email')]);
        }
        MailManager::sendMailToAdminAndSender(
            $contactDto->get('email'),
            'Nouveau message depuis le formulaire de contact de Moge Tee',
            'contact-us', [
                'email' => $contactDto->get('email'),
                'subject' => $contactDto->get('subject'),
                'message' => $contactDto->get('message')
            ]
        );

        $redirect->goTo(['Message envoyé avec succès !']);
    }
}