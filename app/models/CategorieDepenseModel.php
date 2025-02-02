<?php

namespace app\models;

use Flight;

class CategorieDepenseModel
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    // Récupérer une catégorie de dépense par ID
    public function getCategorieDepense($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories_depense WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Récupérer toutes les catégories de dépenses
    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories_depense");
        return $stmt->fetchAll();
    }

    // Ajouter une catégorie de dépense
    public function addCategorieDepense($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO categories_depense (nom) VALUES (?)");
            $stmt->execute([$data["nom"]]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
        }
    }

    // Modifier une catégorie de dépense
    public function updateCategorieDepense($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE categories_depense SET nom = ? WHERE id = ?");
            $stmt->execute([$data["nom"], $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la modification de la catégorie : " . $e->getMessage());
        }
    }

    // Supprimer une catégorie de dépense
    public function deleteCategorieDepense($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM categories_depense WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }


    public function getConfigurationActive()
    {
        $sql = "SELECT `salaire_kg`, `poids_minimal`, `bonus_pourcentage`, `malus_pourcentage`
            FROM `configuration` 
            WHERE `actif` = 1;
            ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }
}
