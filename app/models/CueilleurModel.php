<?php

namespace app\models;

use Flight;

class CueilleurModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getCueilleur($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cueilleurs  WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getPoidsMaxParcelle($id)
    {
        $stmt = $this->db->prepare(
            "SELECT (p.surface * 10000 / COALESCE(v.surface_pied, 1)) * COALESCE(v.rendement_pied, 0) AS poids_max
            FROM parcelles p
            JOIN varietes_the v ON p.variete_the_id = v.id
            WHERE p.id = ?"
        );        
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function countCueilleurs()
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM cueilleurs");
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getAllCueilleurs()
    {
        $stmt = $this->db->query("SELECT * FROM cueilleurs");
        return $stmt->fetchAll();
    }

    public function addCueilleur($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO cueilleurs (nom, genre, date_naissance) VALUES (?, ?, ?)");
            $stmt->execute([
                $data["nom"],
                $data["genre"],
                $data["date_naissance"]
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du véhicule : " . $e->getMessage());
        }
    }

    public function updateCueilleur($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE cueilleurs SET nom = ?, genre = ?, date_naissance = ? WHERE id = ?");
            $stmt->execute([
                $data["nom"],
                $data["genre"],
                $data["date_naissance"],
                $id
            ]);
        } catch (\Throwable $th) {
            throw new \Exception("Erreur lors de la modification du véhicule : " . $th->getMessage());
        }
    }

    public function deleteCueilleur($id)
    {
        $stmt = $this->db->prepare("DELETE FROM cueilleurs WHERE Id = ?");
        $stmt->execute([$id]);
    }
}
