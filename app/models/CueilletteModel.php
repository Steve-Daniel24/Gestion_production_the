<?php

namespace app\models;

use Flight;

class CueilletteModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getCueillette($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cueillettes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllCueillettes()
    {
        $stmt = $this->db->query("SELECT * FROM cueillettes");
        return $stmt->fetchAll();
    }

    public function addCueillete($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO cueillettes (date, cueilleur_id, parcelle_id, poids) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $data["date"],
                $data["cueilleur_id"],
                $data["parcelle_id"],
                $data["poids"]
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout de la cueillette : " . $e->getMessage());
        }
    }

    public function updateCueillette($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE cueillettes SET date = ?, cueilleur_id = ?, parcelle_id = ?, poids = ? WHERE id = ?");
            $stmt->execute([
                $data["date"],
                $data["cueilleur_id"],
                $data["parcelle_id"],
                $data["poids"],
                $id
            ]);
        } catch (\Throwable $th) {
            throw new \Exception("Erreur lors de la modification de la cueillette : " . $th->getMessage());
        }
    }

    public function deleteCueillette($id)
    {
        $stmt = $this->db->prepare("DELETE FROM cueillettes WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getTotalPoidsParParcelle($parcelle_id)
    {
        $stmt = $this->db->prepare("SELECT SUM(poids) AS total_poids FROM cueillettes WHERE parcelle_id = ?");
        $stmt->execute([$parcelle_id]);
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
}
