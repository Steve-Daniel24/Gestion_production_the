<?php

namespace app\models;

use Flight;
use PDO;

class ParcelleModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function getAllParcelles()
    {
        $stmt = $this->db->query("SELECT * FROM parcelles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllParcellesWithVarieteName()
    {
        $stmt = $this->db->query("SELECT 
                                    p.id AS parcelle_id,
                                    p.numero,
                                    p.surface,
                                    v.id AS variete_id,
                                    v.nom AS variete_nom
                                FROM parcelles p
                                JOIN varietes_the v ON p.variete_the_id = v.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParcelle($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM parcelles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addParcelle($data)
    {
        $stmt = $this->db->prepare("INSERT INTO parcelles (numero, surface, variete_the_id) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['numero'],
            $data['surface'],
            $data['variete_the_id']
        ]);
    }

    public function updateParcelle($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE parcelles SET numero = ?, surface = ?, variete_the_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['numero'],
            $data['surface'],
            $data['variete_the_id'],
            $id
        ]);
    }

    public function deleteParcelle($id)
    {
        $stmt = $this->db->prepare("DELETE FROM parcelles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countParcelles()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM parcelles");
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}
