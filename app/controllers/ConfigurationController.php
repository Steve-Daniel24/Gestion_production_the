<?php

namespace app\controllers;

use Flight;

class ConfigurationController
{
    public function __construct() {}

    public function showConfiguration()
    {
        $config = Flight::ConfigurationModel()->getConfiguration();
        Flight::render('configuration', ['config' => $config]);
    }

    public function addConfiguration()
    {
        $request = Flight::request();
        $salaire_kg = $request->data->salaire_kg;
        $poids_minimal = $request->data->poids_minimal;
        $bonus_pourcentage = $request->data->bonus_pourcentage;
        $malus_pourcentage = $request->data->malus_pourcentage;

        if (empty($salaire_kg) || empty($poids_minimal) || empty($bonus_pourcentage) || empty($malus_pourcentage)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'salaire_kg' => $salaire_kg,
            'poids_minimal' => $poids_minimal,
            'bonus_pourcentage' => $bonus_pourcentage,
            'malus_pourcentage' => $malus_pourcentage,
            'actif' => 1
        ];

        Flight::ConfigurationModel()->addConfiguration($data);
        Flight::redirect('/configuration');
    }

    public function updateConfiguration($id)
    {
        $request = Flight::request();
        $salaire_kg = $request->data->salaire_kg;
        $poids_minimal = $request->data->poids_minimal;
        $bonus_pourcentage = $request->data->bonus_pourcentage;
        $malus_pourcentage = $request->data->malus_pourcentage;

        if (empty($salaire_kg) || empty($poids_minimal) || empty($bonus_pourcentage) || empty($malus_pourcentage)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'salaire_kg' => $salaire_kg,
            'poids_minimal' => $poids_minimal,
            'bonus_pourcentage' => $bonus_pourcentage,
            'malus_pourcentage' => $malus_pourcentage
        ];

        Flight::ConfigurationModel()->updateConfiguration($id, $data);
        Flight::redirect('/configuration');
    }

    public function deleteConfiguration($id)
    {
        Flight::ConfigurationModel()->deleteConfiguration($id);
        Flight::json(['status' => 'Configuration supprimée avec succès']);
        Flight::redirect('/configuration');
    }

    public function activateConfiguration($id)
    {
        Flight::ConfigurationModel()->activateConfiguration($id);
        Flight::redirect('/configuration');
    }
}
