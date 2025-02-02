<?php

namespace app\models;

use Flight;
use PDO;

class VarieteTheModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getAllVarietes()
    {
        $stmt = $this->db->query("SELECT * FROM varietes_the");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariete($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM varietes_the WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addVariete($data)
    {
        $stmt = $this->db->prepare("INSERT INTO varietes_the (nom, surface_pied, rendement_pied, prix_vente) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['nom'],
            $data['surface_pied'],
            $data['rendement_pied'],
            $data['prix_vente']
        ]);
    }

    public function updateVariete($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE varietes_the SET nom = ?, surface_pied = ?, rendement_pied = ?, prix_vente = ? WHERE id = ?");
        return $stmt->execute([
            $data['nom'],
            $data['surface_pied'],
            $data['rendement_pied'],
            $data['prix_vente'],
            $id
        ]);
    }

    public function deleteVariete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM varietes_the WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countVarietes()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM varietes_the");
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}
