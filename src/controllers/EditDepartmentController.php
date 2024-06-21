<?php

namespace src\controllers;

use src\core\View;
use src\libs\dto\DepartmentIdDto;
use src\libs\dto\NameDto;
use src\libs\dto\RoleIdDto;
use src\libs\dto\UpdateDepartmentDto;
use src\libs\dto\UpdateRoleDto;
use src\models\department\DepartmentRepository;

class EditDepartmentController extends Controller
{
    public function get(): void
    {
        $departments = (new DepartmentRepository())->getAllDepartment();
        $this->setTitle('Gérer les départements');
        $this->renderPage('manage-departments', [
            'page-title' => 'Administration: gestion des départements',
            'bgImage' => 'assets/images/backgrounds/configuration-background-1.webp',
            'departments' => $departments
        ]);
    }

    public function post(): void
    {
        $nameDto = new NameDto($_POST);
        if (!$nameDto->isValidDto()){
            View::redirect()->goToError($nameDto->getErrors());
        }

        $departmentRepository = new DepartmentRepository();
        $isAdd = $departmentRepository->addDepartment($nameDto);
        if (!$isAdd){
            View::redirect()->goToError(['Le nom du département existe déjà.']);
        }
        View::redirect()->goTo(['Vous avez ajouté un département avec succès.']);
    }

    public function put(): void
    {
        $updateDepartmentDto = new UpdateDepartmentDto($_POST);
        if (!$updateDepartmentDto->isValidDto()){
            View::redirect()->goToError($updateDepartmentDto->getErrors());
        }
        $departmentRepository = new DepartmentRepository();
        $isUpdate = $departmentRepository->updateDepartment($updateDepartmentDto);
        if (!$isUpdate){
            View::redirect()->goToError(["Le nom du département existe déjà."]);
        }
        View::redirect()->goTo(['Vous avez modifié un département avec succès.']);
    }

    public function del(): void
    {
        $DepartmentIdDto = new DepartmentIdDto($_GET);
        if (!$DepartmentIdDto->isValidDto()){
            View::redirect()->goToError($DepartmentIdDto->getErrors());
        }
        $departmentRepository = new DepartmentRepository();
        $isDel = $departmentRepository->delDepartment($DepartmentIdDto);
        if ($isDel === 0){
            View::redirect()->goToError(["Le département n'existe pas."]);
        } elseif ($isDel === -1){
            View::redirect()->goToError(["Impossible de supprimer ce département. Il y a des membres associés à celui-ci."]);
        }
        View::redirect()->goTo(['Vous avez supprimé un département avec succès.']);
    }
}