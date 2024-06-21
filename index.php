<?php

$DEV_MODE = isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'localhost');

setlocale (LC_TIME, 'fr_FR.utf8','fra');

session_start();

require_once 'src/core/AutoLoader.php';
require_once 'src/config.' . ($DEV_MODE ? 'dev' : 'prod') . '.php';;

use src\controllers\ActualityController;
use src\controllers\ConsultTeamController;
use src\controllers\ContactController;
use src\controllers\HomeController;
use src\controllers\AuthController;
use src\controllers\ResetPasswordController;
use src\core\AutoLoader;
use src\core\Router;
use src\libs\middleware\GuestMiddleware;
use src\libs\middleware\AuthMiddleware;
use src\controllers\EditActualityController;
use src\controllers\EditUserController;
use src\controllers\EditPasswordController;
use src\libs\middleware\AdminMiddleware;
use src\controllers\AddUserController;
use src\controllers\EditRoleController;
use src\controllers\EditDepartmentController;

(new AutoLoader())->init();

$router = new Router();

$router->add('', HomeController::class, Router::GET);
$router->add('accueil', HomeController::class, Router::GET);

$router->add('contact', ContactController::class, Router::GET);
$router->add('contact', ContactController::class, Router::POST);

$router->add('connexion', AuthController::class, Router::GET, [GuestMiddleware::class]);
$router->add('connexion', AuthController::class, Router::POST, [GuestMiddleware::class]);
$router->add('deconnexion', AuthController::class, Router::DEL, [AuthMiddleware::class]);


$router->add('reinitialiser-mot-de-passe', ResetPasswordController::class, Router::GET, [GuestMiddleware::class]);
$router->add('reinitialiser-mot-de-passe', ResetPasswordController::class, Router::PATCH, [GuestMiddleware::class]);

$router->add('consulter-equipe', ConsultTeamController::class, Router::GET);

$router->add('actualites', ActualityController::class, Router::GET);
$router->add('actualites', ActualityController::class, Router::POST);

$router->add('editer-actualite', EditActualityController::class, Router::GET, [AuthMiddleware::class]);
$router->add('editer-actualite', EditActualityController::class, Router::PUT, [AuthMiddleware::class]);
$router->add('editer-actualite', EditActualityController::class, Router::POST, [AuthMiddleware::class]);
$router->add('editer-actualite', EditActualityController::class, Router::DEL, [AuthMiddleware::class]);

$router->add('editer-profil', EditUserController::class, Router::GET, [AuthMiddleware::class]);
$router->add('editer-profil', EditUserController::class, Router::PUT, [AuthMiddleware::class]);
$router->add('supprimer-membre', EditUserController::class, Router::DEL, [AdminMiddleware::class]);

$router->add('ajouter-membre', AddUserController::class, Router::GET, [AdminMiddleware::class]);
$router->add('ajouter-membre', AddUserController::class, Router::POST, [AdminMiddleware::class]);

$router->add('changer-mot-de-passe', EditPasswordController::class, Router::GET, [AuthMiddleware::class]);
$router->add('changer-mot-de-passe', EditPasswordController::class, Router::PATCH, [AuthMiddleware::class]);

$router->add('roles', EditRoleController::class, Router::GET, [AdminMiddleware::class]);
$router->add('roles', EditRoleController::class, Router::POST, [AdminMiddleware::class]);
$router->add('roles', EditRoleController::class, Router::PUT, [AdminMiddleware::class]);
$router->add('roles', EditRoleController::class, Router::DEL, [AdminMiddleware::class]);

$router->add('departments', EditDepartmentController::class, Router::GET, [AdminMiddleware::class]);
$router->add('departments', EditDepartmentController::class, Router::POST, [AdminMiddleware::class]);
$router->add('departments', EditDepartmentController::class, Router::PUT, [AdminMiddleware::class]);
$router->add('departments', EditDepartmentController::class, Router::DEL, [AdminMiddleware::class]);

$router->run();