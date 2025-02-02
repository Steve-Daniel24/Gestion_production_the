<?php

namespace app\controllers;

use Flight;

class DepensesControlleur
{
    public function __construct() {}

    public function dashboard()
    {
        $depense_count = Flight::DepenseModel()->countDepenses();
        Flight::render('index', [
            'depense_count' => $depense_count
        ]);
    }

    public function Depenses()
    {
        $DepenseModel = Flight::DepenseModel()->getAllDepenses();
        Flight::render('Depense', ['Depenses' => $DepenseModel]);
    }

    public function updateForm($id)
    {
        $Depense = Flight::DepenseModel()->getDepense($id);
        Flight::render('depenseForm', ['depense' => $Depense]);
    }

    public function DepenseForm()
    {
        Flight::render('depenseForm');
    }

    public function addDepense()
    {
        $request = Flight::request();
        $montant = $request->data->montant;
        $description = $request->data->description;
        $date_depense = $request->data->date_depense;

        if (empty($montant) || empty($description) || empty($date_depense)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'montant' => $montant,
            'description' => $description,
            'date_depense' => $date_depense,
        ];

        Flight::DepenseModel()->addDepense($data);
        Flight::redirect("/Depense/ajouterForm");
    }

    public function updateDepense($id)
    {
        $request = Flight::request();
        $montant = $request->data->montant;
        $description = $request->data->description;
        $date_depense = $request->data->date_depense;

        if (empty($montant) || empty($description) || empty($date_depense)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'montant' => $montant,
            'description' => $description,
            'date_depense' => $date_depense,
        ];

        Flight::DepenseModel()->updateDepense($id, $data);
        Flight::redirect("/Depense");
    }

    public function deleteDepense($id)
    {
        Flight::DepenseModel()->deleteDepense($id);
        Flight::redirect("/Depense");
    }
    
}
