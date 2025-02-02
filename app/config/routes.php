<?php

use app\controllers\ConfigurationController;
use app\controllers\DepensesControlleur;
use app\controllers\CategorieDepenseController;
use app\controllers\ParcellesControlleur;
use app\controllers\VarietesTheControlleur;
use app\controllers\CueilleursControlleur;
use app\controllers\CueilleteController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */
Flight::before('route', function () {
    $protectedRoutes = ['/dashboard', '/gifts', '/admin'];
    $currentRoute = Flight::request()->url;

    if (in_array($currentRoute, $protectedRoutes) && !isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        exit;
    }

    if ($currentRoute == '/admin' && (!isset($_SESSION['user_role'][0]) || $_SESSION['user_role'][0] !== 'admin')) {
        Flight::redirect('/gifts');
        exit;
    }
});

// USER
$cueilleurControlleur = new CueilleursControlleur();
Flight::route('GET /', [$cueilleurControlleur, 'dashboard']);

Flight::route('GET /Cueilleur', [$cueilleurControlleur, 'Cueilleurs']);
Flight::route('POST /Cueilleur/ajouter', [$cueilleurControlleur, 'addCueilleur']);
Flight::route('GET /Cueilleur/ajouterForm', [$cueilleurControlleur, 'CueilleurForm']);
Flight::route('GET /Cueilleur/delete/@id', [$cueilleurControlleur, 'deleteCueilleur']);
Flight::route('GET /Cueilleur/edit/@id', [$cueilleurControlleur, 'updateForm']);
Flight::route('POST /Cueilleur/update/@id', [$cueilleurControlleur, 'updateCueilleur']);

$CueilleteController = new CueilleteController();
Flight::route('GET /Cueilletes/Form', [$CueilleteController, 'formulaireAjoutCueilletes']);
Flight::route('POST /Cueilletes/add', [$CueilleteController, 'addCueillete']);
Flight::route('POST /Cueillettes/poidsMax', [$CueilleteController, 'getPoidsMaxParcelle']);

$VarietesTheControlleur = new VarietesTheControlleur();
Flight::route('GET /Variete', [$VarietesTheControlleur, 'Varietes']);
Flight::route('POST /Variete/ajouter', [$VarietesTheControlleur, 'addvariete']);
Flight::route('GET /Variete/ajouterForm', [$VarietesTheControlleur, 'VarieteForm']);
Flight::route('GET /Variete/delete/@id', [$VarietesTheControlleur, 'deletevariete']);
Flight::route('GET /Variete/edit/@id', [$VarietesTheControlleur, 'updateForm']);
Flight::route('POST /Variete/update/@id', [$VarietesTheControlleur, 'updatevariete']);

$parcelleControlleur = new ParcellesControlleur();
Flight::route('GET /Parcelle', [$parcelleControlleur, 'Parcelles']);
Flight::route('POST /Parcelle/ajouter', [$parcelleControlleur, 'addParcelle']);
Flight::route('GET /Parcelle/ajouterForm', [$parcelleControlleur, 'ParcelleForm']);
Flight::route('GET /Parcelle/delete/@id', [$parcelleControlleur, 'deleteParcelle']);
Flight::route('GET /Parcelle/edit/@id', [$parcelleControlleur, 'updateForm']);
Flight::route('POST /Parcelle/update/@id', [$parcelleControlleur, 'updateParcelle']);

$categoriesDepenseControlleur = new CategorieDepenseController();
Flight::route('GET /CategorieDepense', [$categoriesDepenseControlleur, 'CategoriesDepense']);
Flight::route('POST /CategorieDepense/ajouter', [$categoriesDepenseControlleur, 'addCategorieDepense']);
Flight::route('GET /CategorieDepense/ajouterForm', [$categoriesDepenseControlleur, 'formulaireAddCategorieDepense']);
Flight::route('GET /CategorieDepense/delete/@id', [$categoriesDepenseControlleur, 'deleteCategorieDepense']);
Flight::route('GET /CategorieDepense/edit/@id', [$categoriesDepenseControlleur, 'formulaireModifyCategorieDepense']);
Flight::route('POST /CategorieDepense/update/@id', [$categoriesDepenseControlleur, 'updateCategorieDepense']);

$depenseControlleur = new DepensesControlleur();
Flight::route('GET /Depense', [$depenseControlleur, 'Depenses']);
Flight::route('POST /Depense/ajouter', [$depenseControlleur, 'addDepense']);
Flight::route('GET /Depense/ajouterForm', [$depenseControlleur, 'formulaireAddDepense']);
Flight::route('GET /Depense/delete/@id', [$depenseControlleur, 'deleteDepense']);
Flight::route('GET /Depense/edit/@id', [$depenseControlleur, 'formulaireModifyDepense']);
Flight::route('POST /Depense/update/@id', [$depenseControlleur, 'updateDepense']);

$configurationControlleur = new ConfigurationController();
Flight::route('GET /configuration', [$configurationControlleur, 'configuration']);
Flight::route('POST /configuration/ajouter', [$configurationControlleur, 'addconfiguration']);
Flight::route('GET /configuration/ajouterForm', [$configurationControlleur, 'formulaireAddconfiguration']);
Flight::route('GET /configuration/delete/@id', [$configurationControlleur, 'deleteconfiguration']);
Flight::route('GET /configuration/edit/@id', [$configurationControlleur, 'formulaireModifyconfiguration']);
Flight::route('POST /configuration/update/@id', [$configurationControlleur, 'updateconfiguration']);
