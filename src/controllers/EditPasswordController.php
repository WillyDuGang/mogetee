<?php

namespace src\controllers;

use src\core\Auth;
use src\core\View;
use src\libs\dto\EditPasswordDto;
use src\libs\dto\StaffIdDto;
use src\libs\middleware\AdminMiddleware;
use src\models\staff\Staff;
use src\models\staff\StaffRepository;

class EditPasswordController extends Controller
{
    public function get(): void
    {
        if (isset($_GET['staffID']) && intval($_GET['staffID']) !== Auth::getStaff()->id_staff ){
            (new AdminMiddleware())->before();
            $this->editOtherPassword();
        } else {
            $this->renderEditPasswordPage(Auth::getStaff(), 'Changer votre mot de passe', 'Changement de votre mot de passe');
        }
    }

    private function editOtherPassword(): void{
        $staffIdDto = new StaffIdDto($_GET);
        if (!$staffIdDto->isValidDto()){
            View::redirect('consulter-equipe')->goToError($staffIdDto->getErrors());
        }
        $staffId = (int) $staffIdDto->get('staffID');
        if ($staffId === Auth::getStaff()->id_staff){
            View::redirect()->goTo();
        }

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffById($staffId);
        if (!$staff){
            View::redirect('consulter-equipe', ["Le staff id " . $staffId ." recherchée est introuvable."], true)->goTo();
        }
        $this->renderEditPasswordPage($staff, "Changer le mot de passe d'un membre", "Changement du mot de passe de $staff->firstname $staff->lastname");
    }

    private function renderEditPasswordPage(Staff $staff, string $title, string $pageTitle): void{
        $this->setTitle($title);
        $this->renderPage('edit-password', [
            'page-title' => $pageTitle,
            'bgImage' => 'assets/images/backgrounds/my-profile-background-1.webp',
            'staff' => $staff
        ]);
    }

    public function patch(): void
    {
        $editPasswordDto = new EditPasswordDto($_POST);
        $redirect = View::redirect();

        if (!$editPasswordDto->isValidDto()){
            $redirect->goToError($editPasswordDto->getErrors());
        }

        if (Auth::getStaff()->id_staff !== intval($editPasswordDto->get('staffID'))){
            (new AdminMiddleware())->before();
        }

        //-------->
        if ($editPasswordDto->get('password') !== $editPasswordDto->get('passwordRepetition')){
            $redirect->goToError(
                ['La répétition du mot de passe ne correspond pas au mot de passe'],
                ['staffID' => $editPasswordDto->get('staffID')]
            );
        }

        $staffRepository = new StaffRepository();
        $isUpdate = $staffRepository->updateStaffPasswordByStaffId($editPasswordDto->get('staffID'), $editPasswordDto->get('password'));

        if ($isUpdate){
            $redirect->setLocation('consulter-equipe');
            $redirect->addMessage("Le mot de passe a été modifié avec succès");
            $redirect->addParam('staffID', $editPasswordDto->get('staffID'));
            $redirect->goTo();
        } else {
            $redirect->goToError(
                ["Le mot de passe n'a pas pu être modifié dans la base de donnée"],
                ['staffID' => $editPasswordDto->get('staffID')]
            );
        }
    }
}