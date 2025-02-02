<?php

namespace app\controllers;

use Flight;

class CueilleursControlleur
{
    public function __construct() {}

    public function dashboard()
    {
        $Parcelle_count = Flight::ParcelleModel()->countParcelles();
        $Cueilleur_count = Flight::CueilleurModel()->countCueilleurs();
        $variete_count = Flight::VarieteTheModel()->countVarietes();
        Flight::render('index', [
            'Cueilleur_count' => $Cueilleur_count,
            'variete_count' => $variete_count,
            'parcelle_count' => $Parcelle_count
        ]);
    }

    public function Cueilleurs()
    {
        $CueilleurModel = Flight::CueilleurModel()->getAllCueilleurs();
        Flight::render('Cueilleur', ['Cueilleurs' => $CueilleurModel]);
    }

    public function updateForm($id)
    {
        $Cueilleur = Flight::CueilleurModel()->getCueilleur($id);
        Flight::render('farmerForm', ['cueilleur' => $Cueilleur]);
    }

    public function CueilleurForm()
    {
        Flight::render('farmerForm');
    }

    public function addCueilleur()
    {
        $request = Flight::request();
        $nom = $request->data->nom;
        $genre = $request->data->genre;
        $date_naissance = $request->data->date_naissance;

        if (empty($nom) || empty($genre) || empty($date_naissance)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'nom' => $nom,
            'genre' => $genre,
            'date_naissance' => $date_naissance,
        ];

        Flight::CueilleurModel()->addCueilleur($data);
        Flight::redirect("/Cueilleur/ajouterForm");
    }

    public function updateCueilleur($id)
    {
        $request = Flight::request();
        $nom = $request->data->nom;
        $genre = $request->data->genre;
        $date_naissance = $request->data->date_naissance;

        if (empty($nom) || empty($genre) || empty($date_naissance)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $genre = ($genre == "Homme") ? 'M' : 'F';

        $data = [
            'nom' => $nom,
            'genre' => $genre,
            'date_naissance' => $date_naissance,
        ];

        Flight::CueilleurModel()->updateCueilleur($id, $data);
        Flight::json(['status' => $genre]);
        Flight::redirect("/Cueilleur");
    }

    public function deleteCueilleur($id)
    {
        Flight::CueilleurModel()->deleteCueilleur($id);
        Flight::json(['status' => 'Véhicule supprimé avec succès']);
        Flight::redirect("/Cueilleur");
    }

    public function formulaireAddCueilleur()
    {
        Flight::render('formulaireAjout');
    }

    public function formulaireModifyCueilleur($id)
    {
        $Cueilleurs = Flight::CueilleurModel()->getCueilleur($id);
        $data = [
            'nom' => $Cueilleurs["nom"],
            'date_naissance' => $Cueilleurs["date_naissance"],
            'genre' => $Cueilleurs["genre"],
        ];
        Flight::render('formulaireModifier', ['data' => $data]);
    }

    public function formulaireAjoutCueilletes()
    {
        $Cueilleur = Flight::CueilleurModel()->getAllCueilleurs();
        $parcelles = Flight::ParcelleModel()->getAllParcellesWithVarieteName();

        Flight::render('FormChoixCueillete', ['cueilleur' => $Cueilleur, 'parcelles' => $parcelles]);
    }

    public function getPoidsMaxParcelle()
    {
        $request = Flight::request();
        $parcelle_id = $request->data->parcelle_id;
        $poids = $request->data->poids;

        $PoidsMaxParcelle = Flight::CueilleurModel()->getPoidsMaxParcelle($parcelle_id);

        if ($PoidsMaxParcelle && $poids > $PoidsMaxParcelle['poids_max']) {
            Flight::json(['status' => 'error']);
        } else {
            Flight::json(['status' => 'ok']);
        }
    }
}
