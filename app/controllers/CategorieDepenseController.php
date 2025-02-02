<?php

namespace app\controllers;

use Flight;

class CategorieDepenseController
{
    public function __construct() {}

    public function categoriesDepense()
    {
        $categories = Flight::CategorieDepenseModel()->getAllCategories();
        Flight::render('CategoriesDepense', ['CategoriesDepense' => $categories]);
    }

    public function formulaireAddCategorieDepense()
    {
        Flight::render('Categorie_depenseForm');
    }

    public function formulaireModifyCategorieDepense($id)
    {
        $categorie = Flight::CategorieDepenseModel()->getCategorieDepense($id);
        Flight::render('Categorie_depenseForm', ['categorie' => $categorie]);
    }

    public function addCategorieDepense()
    {
        $request = Flight::request();
        $nom = $request->data->nom;

        if (empty($nom)) {
            Flight::json(['error' => 'Le nom est requis'], 400);
            return;
        }

        $data = ['nom' => $nom];
        Flight::CategorieDepenseModel()->addCategorieDepense($data);
        Flight::redirect("/CategorieDepense");
    }

    public function updateCategorieDepense($id)
    {
        $request = Flight::request();
        $nom = $request->data->nom;

        if (empty($nom)) {
            Flight::json(['error' => 'Le nom est requis'], 400);
            return;
        }

        $data = ['nom' => $nom];
        Flight::CategorieDepenseModel()->updateCategorieDepense($id, $data);
        Flight::redirect("/CategorieDepense");
    }

    public function deleteCategorieDepense($id)
    {
        Flight::CategorieDepenseModel()->deleteCategorieDepense($id);
        Flight::json(['status' => 'Catégorie supprimée avec succès']);
        Flight::redirect("/CategorieDepense");
    }
}
