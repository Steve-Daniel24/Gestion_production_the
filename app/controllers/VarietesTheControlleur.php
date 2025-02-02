<?php

namespace app\controllers;

use app\models\VarieteTheModel;
use Flight;

class VarietesTheControlleur
{
    public function __construct() {}

    public function dashboard()
    {
        $variete_count = Flight::VarieteTheModel()->countVarietes();
        Flight::render('index', ['variete_count' => $variete_count]);
    }

    public function Varietes()
    {
        $varieteModel = Flight::VarieteTheModel()->getAllVarietes();
        Flight::render('varietethe', ['Varietes' => $varieteModel]);
    }

    public function VarieteForm()
    {
        $varietes = Flight::VarieteTheModel()->getAllVarietes();
        Flight::render('varieteForm', ['Varietes' => $varietes]);
    }

    public function addVariete()
    {
        $request = Flight::request();
        $nom = $request->data->nom;
        $surface_pied = $request->data->surface_pied;
        $rendement_pied = $request->data->rendement_pied;
        $prix_vente = $request->data->prix_vente;

        if (empty($nom) || empty($surface_pied) || empty($rendement_pied) || empty($prix_vente)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'nom' => $nom,
            'surface_pied' => $surface_pied,
            'rendement_pied' => $rendement_pied,
            'prix_vente' => $prix_vente,
        ];

        Flight::VarieteTheModel()->addVariete($data);
        Flight::redirect("/Variete/ajouterForm");
    }

    public function updateForm($id)
    {
        $Varietes = Flight::VarieteTheModel()->getVariete($id);
        Flight::render('VarieteForm', ['Variete' => $Varietes]);
    }

    public function updateVariete($id)
    {
        $request = Flight::request();
        $nom = $request->data->nom;
        $surface_pied = $request->data->surface_pied;
        $rendement_pied = $request->data->rendement_pied;
        $prix_vente = $request->data->prix_vente;

        if (empty($nom) || empty($surface_pied) || empty($rendement_pied) || empty($prix_vente)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'nom' => $nom,
            'surface_pied' => $surface_pied,
            'rendement_pied' => $rendement_pied,
            'prix_vente' => $prix_vente,
        ];

        Flight::VarieteTheModel()->updateVariete($id, $data);
        Flight::json(['status' => 'Variété mise à jour avec succès']);
    }

    public function deleteVariete($id)
    {
        Flight::VarieteTheModel()->deleteVariete($id);
        Flight::json(['status' => 'Variété supprimée avec succès']);
        Flight::redirect('/Variete');
    }

    public function formulaireAddVariete()
    {
        Flight::render('formulaireAjoutVariete');
    }

    public function formulaireModifyVariete($id)
    {
        $variete = Flight::VarieteTheModel()->getVariete($id);

        $data = [
            'nom' => $variete["nom"],
            'surface_pied' => $variete["surface_pied"],
            'rendement_pied' => $variete["rendement_pied"],
            'prix_vente' => $variete["prix_vente"]
        ];

        Flight::render('formulaireModifierVariete', ['id' => $id, 'data' => $data]);
    }
}
