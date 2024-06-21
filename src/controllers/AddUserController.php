<?php

namespace src\controllers;

use src\core\View;
use src\libs\dto\AddUserDto;
use src\libs\util\Upload;
use src\models\department\DepartmentRepository;
use src\models\function\FunctionRepository;
use src\models\role\RoleRepository;
use src\models\staff\StaffRepository;

class AddUserController extends Controller
{
    public function get(): void
    {
        $roles = (new RoleRepository())->getAllRole();
        $departments = (new DepartmentRepository())->getAllDepartment();
        $this->setTitle('Ajouter un membre');
        $this->renderPage('add-user', [
            'page-title' => "Ajout d'un nouveau membre",
            'bgImage' => 'assets/images/backgrounds/our-team-background-1.jpg',
            'roles' => $roles,
            'departments' => $departments
        ]);
    }

    public function post(): void
    {
        $_POST['departments_roles'] = $_POST['departments_roles'] ?? [];
        $image = reset($_FILES);
        if (!empty($_FILES) && $image['size'] === 0){
            unset($_POST['image']);
        } else {
            $_POST['image'] = $image;
        }
        $addUserDto = new AddUserDto($_POST);
        unset($_POST['image']);
        unset($_POST['password']);
        unset($_POST['passwordRepetition']);
        $redirect = View::redirect();
        if (!$addUserDto->isValidDto()){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError($addUserDto->getErrors(), $_POST);
        }

        if ($addUserDto->get('password') !== $addUserDto->get('passwordRepetition')){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError(['La répétition du mot de passe ne correspond pas au mot de passe'], $_POST);
        }

        $imageName = null;
        if ($addUserDto->get('image') !== null){
            $imageName = Upload::generateUniqueFileName($addUserDto->get('image'));
        }

        $staffRepository = new StaffRepository();
        $targetStaff = $staffRepository->getStaffByEmail($addUserDto->get('email'));
        if ($targetStaff){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError(
                ["L'e-mail est déjà associé a un autre comptes"],
                $_POST
            );
        }

        $newUserId = $staffRepository->addStaff($addUserDto, $imageName);
        if($newUserId === false){
            $_POST['departments_roles'] = serialize($_POST['departments_roles']);
            $redirect->goToError(
                ["Une erreur est survenue lors de la modification dans la base de donnée"],
                $_POST
            );
        }
        if ($imageName !== null){
            Upload::newFile($addUserDto->get('image'), Upload::PROFILE_PICTURE, $imageName);
        }

        $staffFunctionRepository = new FunctionRepository();
        $staffFunctionRepository->updateStaffFunction($newUserId, $addUserDto->get('departments_roles'));

        $redirect->setLocation('consulter-equipe');
        $redirect->addMessage("Vous avez ajouter un nouveau membre avec succès");
        $redirect->addParam('staffID', $newUserId);
        $redirect->goTo();

    }
}