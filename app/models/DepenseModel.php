<?php

namespace app\models;

use Flight;

class DepenseModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getDepense($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM depenses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function countDepenses()
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM depenses");
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getAllDepenses()
    {
        $stmt = $this->db->query("SELECT * FROM depenses");
        return $stmt->fetchAll();
    }

    public function addDepense($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO depenses (montant, description, date_depense) VALUES (?, ?, ?)");
            $stmt->execute([
                $data["montant"],
                $data["description"],
                $data["date_depense"]
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout de la dépense : " . $e->getMessage());
        }
    }

    public function updateDepense($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE depenses SET montant = ?, description = ?, date_depense = ? WHERE id = ?");
            $stmt->execute([
                $data["montant"],
                $data["description"],
                $data["date_depense"],
                $id
            ]);
        } catch (\Throwable $th) {
            throw new \Exception("Erreur lors de la modification de la dépense : " . $th->getMessage());
        }
    }

    public function deleteDepense($id)
    {
        $stmt = $this->db->prepare("DELETE FROM depenses WHERE id = ?");
        $stmt->execute([$id]);
    }
}
