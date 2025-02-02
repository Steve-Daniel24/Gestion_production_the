<?php

namespace app\controllers;

use Flight;

class ParcellesControlleur
{
    public function __construct() {}

    public function dashboard()
    {
        $parcelle_count = Flight::ParcelleModel()->countParcelles();
        Flight::render('index', ['parcelle_count' => $parcelle_count]);
    }

    public function parcelles()
    {
        $parcelles = Flight::ParcelleModel()->getAllParcellesWithVarieteName();
        Flight::render('parcelles', ['Parcelles' => $parcelles]);
    }

    public function parcelleForm()
    {
        $variete = Flight::VarieteTheModel()->getAllVarietes();
        Flight::render('parcelleForm', ['varietes' => $variete]);
    }

    public function updateForm($id)
    {
        $parcelles = Flight::ParcelleModel()->getParcelle($id);
        $variete = Flight::VarieteTheModel()->getAllVarietes();
        Flight::render('parcelleForm', ['parcelle' => $parcelles, 'varietes' => $variete]);
    }

    public function addParcelle()
    {
        $request = Flight::request();
        $numero = $request->data->numero;
        $surface = $request->data->surface;
        $variete_the_id = $request->data->variete_the_id;

        if (empty($numero) || empty($surface) || empty($variete_the_id)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'numero' => $numero,
            'surface' => $surface,
            'variete_the_id' => $variete_the_id,
        ];

        Flight::ParcelleModel()->addParcelle($data);
        Flight::redirect('/Parcelle');
    }

    public function updateParcelle($id)
    {
        $request = Flight::request();
        $numero = $request->data->numero;
        $surface = $request->data->surface;
        $variete_the_id = $request->data->variete_the_id;

        if (empty($numero) || empty($surface) || empty($variete_the_id)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'numero' => $numero,
            'surface' => $surface,
            'variete_the_id' => $variete_the_id,
        ];

        Flight::ParcelleModel()->updateParcelle($id, $data);
        Flight::redirect('/Parcelle');
    }

    public function deleteParcelle($id)
    {
        Flight::ParcelleModel()->deleteParcelle($id);
        Flight::redirect('/Parcelle');
    }

    public function formulaireAddParcelle()
    {
        Flight::render('formulaireAjoutParcelle');
    }

    public function formulaireModifyParcelle($id)
    {
        $parcelle = Flight::ParcelleModel()->getParcelle($id);
        Flight::render('formulaireModifierParcelle', ['id' => $id, 'parcelle' => $parcelle]);
    }
}
