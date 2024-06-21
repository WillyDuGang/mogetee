<?php

namespace src\controllers;


use src\core\Auth;
use src\core\View;
use src\libs\dto\StaffIdDto;
use src\models\function\FunctionRepository;
use src\models\staff\StaffRepository;

class ConsultTeamController extends Controller
{

    public function get(): void
    {
        if (isset($_GET['staffID'])){
            $this->consultStaff();
        } else {
            $this->consultTeam();
        }
    }

    private function consultTeam(): void
    {
        $this->setTitle('Consulter notre équipe');

        $staffFunctionRepository = new FunctionRepository();

        $allStaff = $staffFunctionRepository->getAllStaffFunction();

        $staffFunctionsByDepartment = [];
        foreach ($allStaff as $staffFunction) {
            $department = $staffFunction->department;
            if (!isset($staffFunctionsByDepartment[$department])) {
                $staffFunctionsByDepartment[$department] = [];
            }
            $staffFunctionsByDepartment[$department][] = $staffFunction;
        }
        $this->renderPage('consult-team', [
            'page-title' => 'Consulter notre équipe',
            'bgImage' => 'assets/images/backgrounds/our-team-background-1.jpg',
            'staffs' => $staffFunctionsByDepartment
        ]);
    }

    private function consultStaff(): void
    {
        $staffIdDto = new StaffIdDto($_GET);

        if (!$staffIdDto->isValidDto()){
            View::redirect(null, $staffIdDto->getErrors(), true)->goTo();
        }

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffById($staffIdDto->get('staffID'));

        if (!$staff){
            View::redirect(null, ['Le membre recherché est introuvable.'], true)->goTo();
        }

        $functionRepository = new FunctionRepository();
        $allRoleDepartment = $functionRepository->getAllRoleDepartmentByStaffId($staff->id_staff);

        $this->setTitle('Consulter un membre');
        $this->renderPage('consult-staff', [
            'page-title' => 'Consulter un membre',
            'bgImage' => 'assets/images/backgrounds/our-team-background-1.jpg',
            'staff' => $staff,
            'allRoleDepartment' => $allRoleDepartment
        ]);
    }

}