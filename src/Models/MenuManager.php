<?php

namespace Panier\Models;

use Panier\Models\Menu;

/** Class UserManager **/
class MenuManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function find()
    {
        $stmt = $this->bdd->prepare("SELECT NOMPRODUIT, PRIXPRODUIT , POIDSPRODUIT , NOMORIGINE , NOMCATEGORIE, NOMTYPE, NOMINGREDIENT FROM produit LEFT JOIN origine ON produit.IDORIGINE = origine.IDORIGINE LEFT JOIN categorie ON produit.IDCATEGORIE = produit.IDCATEGORIE LEFT JOIN type ON type.IDTYPE = produit.IDTYPE LEFT JOIN contenir ON produit.IDPRODUIT = contenir.IDPRODUIT LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE origine.IDORIGINE = ? AND ingredients.IDINGREDIENT = ? AND NOMPRODUIT LIKE '%?%' AND PRIXPRODUIT BETWEEN ? AND ?;");
        $stmt->execute(array(
            $_POST["nat"],
            $_POST["form"],
            $_POST["plat"],
            $_POST["prixmini"],
            $_POST["prixmaxi"],
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "Panier\Models\Menu");

        return $stmt->fetch();
    }
    public function allForm($id)
    {
        $stmt = $this->bdd->prepare("SELECT NOM_FORMATEUR AS NOMFORM, DATE_DEBUT , DATE_FIN, salle.LIBELLE AS salle FROM Panier_formateur LEFT JOIN formateur ON Panier_formateur.ID_FORMATEUR = formateur.ID_FORMATEUR LEFT JOIN salle on salle.ID_SALLE = formateur.ID_SALLE LEFT JOIN persone ON persone.ID_PERSONE = Panier_formateur.ID_PERSONE WHERE persone.ID_PERSONE = ?");
        $stmt->execute(array(
            $id
        ));
        // var_dump($stmt->fetchAll());
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }

    public function store()
    {
        $stmt = $this->bdd->prepare("INSERT INTO persone (NOM, PRENOM, ID_NATION, ID_FORM) VALUES (?,?,?,?)");
        $stmt->execute(array(
            $_POST["name"],
            $_POST["prenom"],
            $_POST['nat'],
            $_POST['form'],
        ));
    }
    public function lastid()
    {
        $stmt = $this->bdd->prepare("SELECT LAST_INSERT_ID() AS lastid");
        $stmt->execute(array());
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function storeformation($date, $date1, $idform, $form)
    {
        echo $idform;
        $stmt = $this->bdd->prepare("INSERT INTO Panier_formateur (ID_PERSONE, ID_FORMATEUR, DATE_DEBUT, DATE_FIN) VALUES (?,?,?,?)");
        $stmt->execute(array(
            $idform,
            $form,
            date_format($date, 'Y-m-d'),
            date_format($date1, 'Y-m-d'),
        ));
    }

    public function update($slug)
    {
        $stmt = $this->bdd->prepare("UPDATE persone SET NOM = ? ,PRENOM = ? ,ID_NATION = ? ,ID_FORM = ? WHERE ID_PERSONE = ?");
        $stmt->execute(array(
            $_POST['nom'], 
            $_POST['prenom'], 
            $_POST['nat'], 
            $_POST['form'], 
            $slug
        ));
    }
    public function deleteupdate($slug)
    {

        $stmt = $this->bdd->prepare("DELETE FROM Panier_formateur WHERE ID_PERSONE = ?");
        $stmt->execute(array(
            $slug
        ));
    }
    public function insertupdate($slug,$form,$dateDeb,$dateFin)
    {
        $stmt = $this->bdd->prepare("INSERT INTO Panier_formateur (ID_PERSONE, ID_FORMATEUR, DATE_DEBUT, DATE_FIN) VALUES (?,?,?,?);");
        $stmt->execute(array(
            $slug, 
            $form, 
            $dateDeb, 
            $dateFin
        ));
    }
    
    public function delete($slug)
    {

        $stmt = $this->bdd->prepare("DELETE FROM Panier_formateur WHERE ID_PERSONE = ?");
        $stmt->execute(array(
            $slug
        ));
        $stmt = $this->bdd->prepare("DELETE FROM persone WHERE ID_PERSONE = ?");
        $stmt->execute(array(
            $slug
        ));
    }

    public function getAllIngredient()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM ingredients');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getAllOrigine()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM origine');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getAllFormateur()
    {
        $stmt = $this->bdd->prepare('SELECT ID_FORMATEUR , PRENOM_FORMATEUR , NOM_FORMATEUR , LIBELLE FROM formateur LEFT JOIN salle on salle.ID_SALLE = formateur.ID_SALLE');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getAllFormateur2($formateur)
    {
        $stmt = $this->bdd->prepare('SELECT ID_FORM AS IdDuFormateur FROM type_formation_formateur WHERE type_formation_formateur.ID_FORMATEUR =' . $formateur);
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getAll()
    {
        $stmt = $this->bdd->prepare("SELECT PRENOM, NOM , LIBELLE_NATION , LIBELLE_FORM ,persone.ID_PERSONE AS persone FROM persone LEFT JOIN nationalite ON persone.ID_NATION = nationalite.ID_NATION LEFT JOIN formation ON formation.ID_FORM = persone.ID_FORM");
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
}
