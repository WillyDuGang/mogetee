<?php

namespace src\controllers;

use src\core\Auth;
use src\core\View;
use src\libs\dto\StaffIdDto;
use src\libs\dto\UpdateStaffDto;
use src\libs\middleware\AdminMiddleware;
use src\libs\util\Upload;
use src\models\department\DepartmentRepository;
use src\models\function\FunctionRepository;
use src\models\role\RoleRepository;
use src\models\staff\Staff;
use src\models\staff\StaffRepository;

class EditUserController extends Controller
{
    public function get(): void
    {
        if (isset($_GET['staffID']) && intval($_GET['staffID']) !== Auth::getStaff()->id_staff)
        {
            (new AdminMiddleware())->before();

            $this->editOtherProfilePage();
        } else {
            $this->renderEditPage(Auth::getStaff(), 'Éditer votre profil', 'Édition de votre profil');
        }
    }


    public function del(): void
    {
        $staffIdDto = new StaffIdDto($_GET);
        if (!$staffIdDto->isValidDto()){
            View::redirect('consulter-equipe')->goToError($staffIdDto->getErrors());
        }
        $staffId = (int) $staffIdDto->get('staffID');
        if ($staffId === Auth::getStaff()->id_staff){
            View::redirect('consulter-equipe')->goToError(
                ['Vous ne pouvez pas vous supprimer vous-même'],
                ['staffID' => $staffId]
            );
        }
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffById($staffId);
        $isDel = $staffRepository->delStaffById($staffId);
        if (!$isDel){
            View::redirect('consulter-equipe', ["Le membre choisi n'existe pas."], true)->goTo();
        }
        if ($staff->profile_picture){
            Upload::removeFile(Upload::PROFILE_PICTURE, $staff->profile_picture);
        }
        View::redirect('consulter-equipe', ['Vous avez supprimé un membre avec succès'])->goTo();
    }

    private function editOtherProfilePage(): void
    {
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
        $this->renderEditPage($staff, "Éditer le profil d'un membre", "Édition du profil de $staff->firstname $staff->lastname");
    }

    private function renderEditPage(Staff $staff, string $title, string $pageTitle): void
    {
        $staffRoles = (new FunctionRepository())->getAllRoleDepartmentByStaffId($staff->id_staff);
        $roles = (new RoleRepository())->getAllRole();
        $departments = (new DepartmentRepository())->getAllDepartment();
        $this->setTitle($title);
        $this->renderPage('edit-profile', [
            'page-title' => $pageTitle,
            'bgImage' => 'assets/images/backgrounds/my-profile-background-1.webp',
            'staff' => $staff,
            'staffRoles' => $staffRoles,
            'roles' => $roles,
            'departments' => $departments
        ]);
    }

    public function put(): void
    {
        $_POST['departments_roles'] = $_POST['departments_roles'] ?? [];
        $image = reset($_FILES);
        if (!empty($_FILES) && $image['size'] === 0){
            unset($_POST['image']);
        } else {
            $_POST['image'] = $image;
        }
        $updateStaffDto = new UpdateStaffDto($_POST);
        unset($_POST['image']);
        unset($_POST['_method']);
        $redirect = View::redirect();
        if (!$updateStaffDto->isValidDto()){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError($updateStaffDto->getErrors(), $_POST);
        }

        if (Auth::getStaff()->id_staff !== intval($updateStaffDto->get('staffID'))){
            (new AdminMiddleware())->before();
        }

        //-------->
        $imageName = null;
        if ($updateStaffDto->get('image') !== null){
            $imageName = Upload::generateUniqueFileName($updateStaffDto->get('image'));
        }

        $staffRepository = new StaffRepository();
        $targetStaff = $staffRepository->getStaffByEmail($updateStaffDto->get('email'));
        if ($targetStaff && intval($updateStaffDto->get('staffID')) !== $targetStaff->id_staff){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError(
                ["L'e-mail est déjà associé a un autre comptes"],
                $_POST
            );
        }

        $staffRepository->updateStaffProfile($updateStaffDto, $imageName);
        if ($imageName !== null){
            Upload::newFile($updateStaffDto->get('image'), Upload::PROFILE_PICTURE, $imageName);
            if ($targetStaff->profile_picture){
                Upload::removeFile(Upload::PROFILE_PICTURE, $targetStaff->profile_picture);
            }
        }

        $staffFunctionRepository = new FunctionRepository();
        $staffFunctionRepository->updateStaffFunction($updateStaffDto->get('staffID'), $updateStaffDto->get('departments_roles'));

        $redirect->setLocation('consulter-equipe');
        $redirect->addMessage("Le profil a été modifié avec succès");
        $redirect->addParam('staffID', $updateStaffDto->get('staffID'));
        $redirect->goTo();
    }
}