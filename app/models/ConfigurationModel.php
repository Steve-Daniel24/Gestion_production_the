<?php

namespace app\models;

use Flight;

class ConfigurationModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getActiveConfiguration()
    {
        $stmt = $this->db->query("SELECT * FROM configuration WHERE actif = 1 ORDER BY id DESC LIMIT 1");
        return $stmt->fetch();
    }

    public function getAllConfigurations()
    {
        $stmt = $this->db->query("SELECT * FROM configuration ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function addConfiguration($data)
    {
        try {
            // Désactiver l'ancienne configuration active
            $this->db->query("UPDATE configuration SET actif = 0 WHERE actif = 1");
            
            // Insérer la nouvelle configuration
            $stmt = $this->db->prepare("INSERT INTO configuration (salaire_kg, poids_minimal, bonus_pourcentage, malus_pourcentage, actif) VALUES (?, ?, ?, ?, 1)");
            $stmt->execute([
                $data["salaire_kg"],
                $data["poids_minimal"],
                $data["bonus_pourcentage"],
                $data["malus_pourcentage"]
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout de la configuration : " . $e->getMessage());
        }
    }

    public function updateConfiguration($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE configuration SET salaire_kg = ?, poids_minimal = ?, bonus_pourcentage = ?, malus_pourcentage = ? WHERE id = ?");
            $stmt->execute([
                $data["salaire_kg"],
                $data["poids_minimal"],
                $data["bonus_pourcentage"],
                $data["malus_pourcentage"],
                $id
            ]);
        } catch (\Throwable $th) {
            throw new \Exception("Erreur lors de la modification de la configuration : " . $th->getMessage());
        }
    }

    public function deleteConfiguration($id)
    {
        $stmt = $this->db->prepare("DELETE FROM configuration WHERE id = ?");
        $stmt->execute([$id]);
    }
}
