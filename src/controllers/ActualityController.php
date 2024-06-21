<?php

namespace src\controllers;

use src\core\View;
use src\libs\alert\Alert;
use src\libs\cookie\ActualityFilter;
use src\libs\dto\ActualityFilterDto;
use src\libs\dto\ActualityIdDto;
use src\models\actuality\ActualityRepository;
use src\models\department\DepartmentRepository;

class ActualityController extends Controller
{

    public function get(): void
    {
        if (isset($_GET['actualityID'])){
            $this->consultActuality();
        } else {
            $this->consultActualitiesList();
        }
    }

    public function post(): void
    {
        if (empty($_POST['keywords'])){
            unset($_POST['keywords']);
        }

        $actualityFilterDto = new ActualityFilterDto($_POST);
        $redirect = View::redirect();
        if (!$actualityFilterDto->isValidDto()){
            $redirect->goToError($actualityFilterDto->getErrors());
        }
        if ($keywords = $actualityFilterDto->get('keywords')){
            ActualityFilter::setFilter(ActualityFilter::KEYWORDS, $keywords);
        } else {
            ActualityFilter::removeFilter(ActualityFilter::KEYWORDS);
        }
        $department = $actualityFilterDto->get('department');
        if ($department !== null && intval($department) !== -1){
            ActualityFilter::setFilter(ActualityFilter::DEPARTMENT, $department);
        } else {
            ActualityFilter::removeFilter(ActualityFilter::DEPARTMENT);
        }
        $redirect->setLocation('actualites');
        $redirect->goTo(['Les filtres ont bien été appliqués.']);
    }

    private function consultActuality(): void
    {
        $actualityIdDto = new ActualityIdDto($_GET);

        if (!$actualityIdDto->isValidDto()){
            View::redirect(null, $actualityIdDto->getErrors(), true)->goTo();
        }

        $actualityRepository = new ActualityRepository();
        $actuality = $actualityRepository->getActualityById($actualityIdDto->get('actualityID'));

        if (!$actuality){
            View::redirect(null, ["L'actualité id " . $actualityIdDto->get('actualityID') ." recherchée est introuvable."], true)->goTo();
        }

        $this->setTitle($actuality->subject);
        $this->renderPage('consult-actuality', [
            'page-title' => 'Consulter une actualité',
            'bgImage' => 'assets/images/backgrounds/news-background-1.jpg',
            'actuality' => $actuality,
            'departments' => (new DepartmentRepository())->getAllDepartment()
        ]);

    }

    private function consultActualitiesList(): void
    {
        $actualityRepository = new ActualityRepository();

        $actualities = $actualityRepository->getAllActualities(
            ActualityFilter::getFilter(ActualityFilter::KEYWORDS),
            ActualityFilter::getFilter(ActualityFilter::DEPARTMENT),
        );

        $this->setTitle('Actualité');
        $this->renderPage('actualities', [
            'page-title' => 'Actualités',
            'bgImage' => 'assets/images/backgrounds/news-background-1.jpg',
            'actualities' => $actualities,
            'departments' => (new DepartmentRepository())->getAllDepartment()
        ]);
    }
}