<?php

namespace src\controllers;

use src\models\actuality\ActualityRepository;

class HomeController extends Controller
{

    public function get(): void
    {
        $actualityRepository = new ActualityRepository();
        $actualities = $actualityRepository->get2LatestActualities();
        $this->setTitle('Accueil');
        $this->renderPage('home' , ['actualities' => $actualities]);
    }
}