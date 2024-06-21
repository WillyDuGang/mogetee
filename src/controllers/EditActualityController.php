<?php

namespace src\controllers;

use src\core\View;
use src\libs\dto\ActualityIdDto;
use src\libs\dto\AddActualityDto;
use src\libs\dto\EditActualityDto;
use src\libs\util\Upload;
use src\models\actuality\ActualityRepository;
use src\models\department\DepartmentRepository;

class EditActualityController extends Controller
{
    public function get(): void
    {
        if (isset($_GET['actualityID'])){
            $this->editPage();
        } else {
            $this->addPage();
        }
    }

    private function editPage(): void{
        $actualityIdDto = new ActualityIdDto($_GET);
        if (!$actualityIdDto->isValidDto()){
            View::redirect('actualites', $actualityIdDto->getErrors(), true)->goTo();
        }

        $actualityRepository = new ActualityRepository();
        $actuality = $actualityRepository->getActualityById($actualityIdDto->get('actualityID'));

        if (!$actuality){
            View::redirect('actualites', ["L'actualité recherchée est introuvable."], true)->goTo();
        }
        $this->setTitle('Éditer: ' . $actuality->subject);
        $this->renderPage('edit-actuality',[
            'page-title' => "Édition d'une actualité",
            'bgImage' => 'assets/images/backgrounds/news-background-1.jpg',
            'actuality' => $actuality,
            'departments' => (new DepartmentRepository())->getAllDepartment()
        ]);
    }

    private function addPage(): void{
        $this->setTitle('Créer une actualité');
        $this->renderPage('add-actuality',[
            'page-title' => "Création d'une nouvelle actualité",
            'bgImage' => 'assets/images/backgrounds/news-background-1.jpg',
            'departments' => (new DepartmentRepository())->getAllDepartment()
        ]);
    }

    public function put(): void
    {
        $redirect = View::redirect();
        $_POST['isVisible'] = isset($_POST['isVisible']);
        $_POST['date'] = $_POST['date'] ?? date('Y-m-d');
        if (isset($_POST['department']) && intval($_POST['department']) === -1){
            unset($_POST['department']);
        }
        $image = reset($_FILES);
        if (!empty($_FILES) && $image['size'] === 0){
            unset($_POST['image']);
        } else {
            $_POST['image'] = $image;
        }
        if (isset($_POST['introduction'])){
            $_POST['introduction'] = strip_tags($_POST['introduction']);
        }
        $editActualityDto = new EditActualityDto($_POST);
        unset($_POST['image']);
        unset($_POST['_method']);
        $_POST['department'] = $_POST['department'] ?? -1;
        if (!$editActualityDto->isValidDto()){
            $redirect->goToError(
                $editActualityDto->getErrors(),
                $_POST
            );
        }
        $imageName = null;
        if ($editActualityDto->get('image') !== null){
            $imageName = Upload::generateUniqueFileName($editActualityDto->get('image'));
        }
        $actualityRepository = new ActualityRepository();

        $targetActuality = $actualityRepository->getActualityById($editActualityDto->get('actualityID'));
        if (!$targetActuality){
            $redirect->goToError(
                ["L'actualité recherchée est introuvable."],
                $_POST
            );
        }
        $isUpdate = $actualityRepository->updateActuality($editActualityDto, $imageName);
        if($isUpdate === false){
            $redirect->goToError(
                ["Une erreur est survenue lors de la modification dans la base de donnée"],
                $_POST
            );
        }
        if ($imageName !== null){
            Upload::newFile($editActualityDto->get('image'), Upload::ACTUALITY, $imageName);
            Upload::removeFile(Upload::ACTUALITY, $targetActuality->image);
        }

        $redirect->setLocation('actualites');
        $redirect->addParam('actualityID', $editActualityDto->get('actualityID'));
        $redirect->addMessage('Vous avez édité cette actualité avec succès');
        $redirect->goTo();
    }

    public function post(): void
    {
        $redirect = View::redirect();

        $_POST['isVisible'] = isset($_POST['isVisible']);
        $_POST['date'] = $_POST['date'] ?? date('Y-m-d');
        if (isset($_POST['department']) && intval($_POST['department']) === -1){
            unset($_POST['department']);
        }
        $_POST['image'] = reset($_FILES) ?? null;
        if (isset($_POST['introduction'])){
            $_POST['introduction'] = strip_tags($_POST['introduction']);
        }
        $addActualityDto = new AddActualityDto($_POST);
        if (!$addActualityDto->isValidDto()){
            $redirect->goToError($addActualityDto->getErrors());
        }
        $imageName = Upload::generateUniqueFileName($addActualityDto->get('image'));
        $id = (new ActualityRepository())->addActuality($addActualityDto, $imageName);
        if($id === false){
            $redirect->goToError(["Une erreur est survenue lors de l'insertion dans la base de donnée"]);
        }

        Upload::newFile($addActualityDto->get('image'), Upload::ACTUALITY, $imageName);

        $redirect->setLocation('actualites');
        $redirect->addParam('actualityID', $id);
        $redirect->addMessage('Vous avez crée une nouvelle actualité avec succès');
        $redirect->goTo();
    }


    public function del(): void
    {
        $actualityIdDto = new ActualityIdDto($_GET);
        if (!$actualityIdDto->isValidDto()){
            View::redirect('actualites', $actualityIdDto->getErrors(), true)->goTo();
        }

        $actualityRepository = new ActualityRepository();

        $actuality = $actualityRepository->getActualityById($actualityIdDto->get('actualityID'));
        $isDel = $actualityRepository->delActualityById($actualityIdDto->get('actualityID'));

        if (!$isDel){
            View::redirect('actualites', ["L'actualité choisie n'existe pas."], true)->goTo();
        }
        if ($actuality->image){
            Upload::removeFile(Upload::ACTUALITY, $actuality->image);
        }
        View::redirect('actualites', ['Vous avez supprimé une actualité avec succès'])->goTo();
    }
}