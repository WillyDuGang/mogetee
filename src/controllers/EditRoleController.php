<?php

namespace src\controllers;

use src\core\View;
use src\libs\dto\NameDto;
use src\libs\dto\RoleIdDto;
use src\libs\dto\UpdateRoleDto;
use src\models\role\RoleRepository;

class EditRoleController extends Controller
{
    public function get(): void
    {
        $roles = (new RoleRepository())->getAllRole();
        $this->setTitle('Gérer les roles');
        $this->renderPage('manage-roles', [
            'page-title' => 'Administration: gestion des roles',
            'bgImage' => 'assets/images/backgrounds/configuration-background-1.webp',
            'roles' => $roles
        ]);
    }

    public function post(): void
    {
        $nameDto = new NameDto($_POST);
        if (!$nameDto->isValidDto()){
            View::redirect()->goToError($nameDto->getErrors());
        }

        $roleRepository = new RoleRepository();
        $isAdd = $roleRepository->addRole($nameDto);
        if (!$isAdd){
            View::redirect()->goToError(['Le nom du rôle existe déjà.']);
        }
        View::redirect()->goTo(['Vous avez ajouté un rôle avec succès.']);
    }

    public function put(): void
    {
        $updateRoleDto = new UpdateRoleDto($_POST);
        if (!$updateRoleDto->isValidDto()){
            View::redirect()->goToError($updateRoleDto->getErrors());
        }
        $roleRepository = new RoleRepository();
        $isUpdate = $roleRepository->updateRole($updateRoleDto);
        if (!$isUpdate){
            View::redirect()->goToError(["Le nom du rôle existe déjà."]);
        }
        View::redirect()->goTo(['Vous avez modifié un rôle avec succès.']);
    }

    public function del(): void
    {
        $roleIdDto = new RoleIdDto($_GET);
        if (!$roleIdDto->isValidDto()){
            View::redirect()->goToError($roleIdDto->getErrors());
        }
        $roleRepository = new RoleRepository();
        $isDel = $roleRepository->delRole($roleIdDto);
        if ($isDel === 0){
            View::redirect()->goToError(["Le rôle n'existe pas."]);
        } elseif ($isDel === -1){
            View::redirect()->goToError(["Impossible de supprimer ce rôle. Il y a des membres associés à celui-ci."]);
        }
        View::redirect()->goTo(['Vous avez supprimé un rôle avec succès.']);
    }
}