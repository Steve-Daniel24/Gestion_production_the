<?php

namespace app\controllers;

use Flight;

class CueilleteController
{
    public function __construct() {}


    public function formulaireAjoutCueilletes()
    {
        $Cueilleur = Flight::CueilleurModel()->getAllCueilleurs();
        $parcelles = Flight::ParcelleModel()->getAllParcellesWithVarieteName();

        Flight::render('FormChoixCueillete', ['cueilleur' => $Cueilleur, 'parcelles' => $parcelles]);
    }

    public function addCueillete()
    {
        $request = Flight::request();
        $date = $request->data->date;
        $cueilleur_id = $request->data->cueilleur_id;
        $parcelle_id = $request->data->parcelle_id;
        $poids = $request->data->poids;
    
        if (empty($date) || empty($cueilleur_id) || empty($parcelle_id) || empty($poids)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }
    
        $PoidsMaxParcelle = Flight::CueilleurModel()->getPoidsMaxParcelle($parcelle_id);
        if ($PoidsMaxParcelle && $poids > $PoidsMaxParcelle['poids_max']) {
            Flight::json(['status' => 'error', 'message' => 'Poids trop élevé par rapport à la parcelle'], 400);
            return;
        }
    
        $data = [
            'date' => $date,
            'cueilleur_id' => $cueilleur_id,
            'parcelle_id' => $parcelle_id,
            'poids' => $poids
        ];
    
        try {
            Flight::CueilletteModel()->addCueillete($data);
            Flight::json(['status' => 'ok', 'message' => 'Cueillette enregistrée avec succès']);
            Flight::redirect('/Cueilletes/Form');
        } catch (\Exception $e) {
            Flight::json(['error' => 'Erreur lors de l\'ajout de la cueillette : ' . $e->getMessage()], 500);
        }
    }
    
    public function getPoidsMaxParcelle()
    {
        $request = Flight::request();
        $parcelle_id = $request->data->parcelle_id;
        $poids = $request->data->poids;

        $PoidsMaxParcelle = Flight::CueilletteModel()->getPoidsMaxParcelle($parcelle_id);

        if ($PoidsMaxParcelle && $poids > $PoidsMaxParcelle['poids_max']) {
            Flight::json(['status' => 'error']);
        } else {
            Flight::json(['status' => 'ok']);
        }
    }
}
