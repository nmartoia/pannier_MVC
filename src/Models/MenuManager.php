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
        if ($_SESSION["olds"]['prixmaxi'] == "" && $_SESSION["olds"]["prixmini"] == "") {
            $stmt = $this->bdd->prepare("SELECT NOMPRODUIT, PRIXPRODUIT , POIDSPRODUIT , NOMORIGINE , NOMCATEGORIE, EXT,uniteDePoids , NOMTYPE, produit.IDPRODUIT AS IDPRODUIT FROM produit LEFT JOIN origine ON produit.IDORIGINE = origine.IDORIGINE LEFT JOIN categorie ON produit.IDCATEGORIE = categorie.IDCATEGORIE LEFT JOIN type ON type.IDTYPE = produit.IDTYPE LEFT JOIN contenir ON produit.IDPRODUIT = contenir.IDPRODUIT LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE origine.IDORIGINE LIKE '%" . $_SESSION["olds"]["nat"] . "%' AND ingredients.IDINGREDIENT LIKE '%" . $_SESSION["olds"]["form"] . "%' AND NOMPRODUIT LIKE '%" . $_SESSION["olds"]["plat"] . "%';");
            $stmt->execute(array());

            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
        } else if ($_SESSION["olds"]['prixmaxi'] == "") {
            $stmt = $this->bdd->prepare("SELECT NOMPRODUIT, PRIXPRODUIT , POIDSPRODUIT , NOMORIGINE  , EXT, NOMCATEGORIE, uniteDePoids , NOMTYPE, produit.IDPRODUIT AS IDPRODUIT FROM produit LEFT JOIN origine ON produit.IDORIGINE = origine.IDORIGINE LEFT JOIN categorie ON produit.IDCATEGORIE = categorie.IDCATEGORIE LEFT JOIN type ON type.IDTYPE = produit.IDTYPE LEFT JOIN contenir ON produit.IDPRODUIT = contenir.IDPRODUIT LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE origine.IDORIGINE LIKE '%" . $_SESSION["olds"]["nat"] . "%' AND ingredients.IDINGREDIENT LIKE '%" . $_SESSION["olds"]["form"] . "%' AND NOMPRODUIT LIKE '%" . $_SESSION["olds"]["plat"] . "%' AND PRIXPRODUIT > " . $_SESSION["olds"]["prixmini"] . ";");
            $stmt->execute(array());
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
        } else if ($_SESSION["olds"]["prixmini"] == "") {
            $stmt = $this->bdd->prepare("SELECT NOMPRODUIT, PRIXPRODUIT , POIDSPRODUIT , NOMORIGINE ,EXT, NOMCATEGORIE, uniteDePoids , NOMTYPE, produit.IDPRODUIT AS IDPRODUIT FROM produit LEFT JOIN origine ON produit.IDORIGINE = origine.IDORIGINE LEFT JOIN categorie ON produit.IDCATEGORIE = categorie.IDCATEGORIE LEFT JOIN type ON type.IDTYPE = produit.IDTYPE LEFT JOIN contenir ON produit.IDPRODUIT = contenir.IDPRODUIT LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE origine.IDORIGINE LIKE '%" . $_SESSION["olds"]["nat"] . "%' AND ingredients.IDINGREDIENT LIKE '%" . $_SESSION["olds"]["form"] . "%' AND NOMPRODUIT LIKE '%" . $_SESSION["olds"]["plat"] . "%' AND PRIXPRODUIT < " . $_SESSION["olds"]["prixmaxi"] . ";");
            $stmt->execute(array());
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
        } else {
            $stmt = $this->bdd->prepare("SELECT NOMPRODUIT, PRIXPRODUIT , POIDSPRODUIT , NOMORIGINE , EXT, NOMCATEGORIE, uniteDePoids , NOMTYPE, produit.IDPRODUIT AS IDPRODUIT FROM produit LEFT JOIN origine ON produit.IDORIGINE = origine.IDORIGINE LEFT JOIN categorie ON produit.IDCATEGORIE = categorie.IDCATEGORIE LEFT JOIN type ON type.IDTYPE = produit.IDTYPE LEFT JOIN contenir ON produit.IDPRODUIT = contenir.IDPRODUIT LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE origine.IDORIGINE LIKE '%" . $_SESSION["olds"]["nat"] . "%' AND ingredients.IDINGREDIENT LIKE '%" . $_SESSION["olds"]["form"] . "%' AND NOMPRODUIT LIKE '%" . $_SESSION["olds"]["plat"] . "%' AND PRIXPRODUIT BETWEEN " . $_SESSION["olds"]["prixmini"] . " AND " . $_SESSION["olds"]["prixmaxi"] . ";");
            $stmt->execute(array());
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
        }
    }
    public function AllIngredients($id)
    {
        $stmt = $this->bdd->prepare("SELECT NOMINGREDIENT FROM contenir LEFT JOIN ingredients ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT WHERE IDPRODUIT = ?");
        $stmt->execute(
            array(
                $id
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }

    public function panier()
    {
        $stmt = $this->bdd->prepare("SELECT QUANTITE, NOMPRODUIT,PRIXPRODUIT, IDCOMMANDE FROM panier LEFT JOIN produit on panier.IDPRODUIT = produit.IDPRODUIT WHERE IDUSER = ?");
        $stmt->execute(
            array(
                $_SESSION["user"]['id'],
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function historique()
    {
        $stmt = $this->bdd->prepare("SELECT QUANTITE, NOMPRODUIT,PRIXPRODUIT, IDCOMMANDE,DATE,produit.IDPRODUIT, produit.EXT FROM commander LEFT JOIN produit on commander.IDPRODUIT = produit.IDPRODUIT WHERE IDUSER = ?");
        $stmt->execute(
            array(
                $_SESSION["user"]['id'],
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function ingredient($uuid, $nom)
    {
        $stmt = $this->bdd->prepare("INSERT INTO ingredients (IDINGREDIENT, NOMINGREDIENT) VALUES (?,?)");
        $stmt->execute(
            array(
                $uuid,
                $nom
            )
        );
    }
    public function insertIngredient($uuid, $nom)
    {
        $stmt = $this->bdd->prepare("INSERT INTO contenir (IDPRODUIT , IDINGREDIENT ) VALUES (?,?)");
        $stmt->execute(
            array(
                $uuid,
                $nom
            )
        );
    }

    public function update($slug, $quantite, $id)
    {
        $stmt = $this->bdd->prepare("UPDATE panier SET QUANTITE = ? WHERE IDUSER = ? AND IDCOMMANDE = ?");
        $stmt->execute(
            array(
                $quantite,
                $slug,
                $id,
            )
        );
    }
    public function valide($panier)
    {
        $date = date_create();
        $stmt = $this->bdd->prepare("INSERT INTO commander (IDPRODUIT, IDUSER, QUANTITE, IDCOMMANDE ,DATE) VALUES (?,?,?,?,?);");
        $stmt->execute(
            array(
                $panier->getIdProduit(),
                $panier->getIdUser(),
                $panier->getQuantite(),
                $panier->getIdCommande(),
                date_format($date, 'Y-m-d H:i:s')
            )
        );
    }
    public function insertPlat($uuid, $nom, $prix, $poids, $origine, $categorie, $type, $ext, $upoids)
    {
        $stmt = $this->bdd->prepare("INSERT INTO produit (IDPRODUIT, NOMPRODUIT, PRIXPRODUIT, POIDSPRODUIT, IDORIGINE, IDCATEGORIE, IDTYPE, EXT, uniteDePoids) VALUES (?,?,?,?,?,?,?,?,?);");
        $stmt->execute(
            array(
                $uuid,
                $nom,
                $prix,
                $poids,
                $origine,
                $categorie,
                $type,
                $ext,
                $upoids
            )
        );
    }
    public function deleteAll($id)
    {

        $stmt = $this->bdd->prepare("DELETE FROM panier WHERE IDUSER = ?");
        $stmt->execute(
            array(
                $id
            )
        );
    }
    public function recupPanier($id)
    {
        $stmt = $this->bdd->prepare('SELECT IDPRODUIT , IDUSER , QUANTITE ,IDCOMMANDE  FROM panier WHERE IDUSER = ?');
        $stmt->execute(
            array(
                $id
            )
        );

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function findCommande()
    {
        $stmt = $this->bdd->prepare('SELECT IDCOMMANDE FROM panier WHERE IDUSER = ? AND IDPRODUIT = ?');
        $stmt->execute(
            array(
                $_SESSION['user']['id'],
                $_POST['id']
            )
        );

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function ajout()
    {
        $uuid = uniqid();
        $date = date_create();
        $stmt = $this->bdd->prepare("INSERT INTO panier (IDPRODUIT, IDUSER, QUANTITE, IDCOMMANDE, DATE) VALUES (?,?,?,?,?);");
        $stmt->execute(
            array(
                $_POST['id'],
                $_SESSION["user"]["id"],
                $_POST['quantiter'],
                $uuid,
                date_format($date, 'Y-m-d H:i:s')
            )
        );
    }
    public function updatePanier()
    {
        $stmt = $this->bdd->prepare("UPDATE panier SET QUANTITE = QUANTITE + ? WHERE IDUSER = ? AND IDPRODUIT = ?");
        $stmt->execute(
            array(
                $_POST['quantiter'],
                $_SESSION["user"]["id"],
                $_POST['id']
            )
        );
    }
    public function modifIngrediant()
    {
        $stmt = $this->bdd->prepare("UPDATE ingredients SET NOMINGREDIENT = ? WHERE IDINGREDIENT = ?");
        $stmt->execute(
            array(
                $_POST['newName'],
                $_POST['Ingrediant']
            )
        );
    }
    public function delete($slug)
    {

        $stmt = $this->bdd->prepare("DELETE FROM panier WHERE IDCOMMANDE = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
    }
    public function deletIngrediant($slug)
    {

        $stmt = $this->bdd->prepare("DELETE FROM contenir WHERE IDINGREDIENT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
        $stmt = $this->bdd->prepare("DELETE FROM ingredients WHERE IDINGREDIENT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
    }
    public function deletPlat($slug)
    {

        $stmt = $this->bdd->prepare("DELETE FROM contenir WHERE IDPRODUIT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
        $stmt = $this->bdd->prepare("DELETE FROM panier WHERE IDPRODUIT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
        $stmt = $this->bdd->prepare("DELETE FROM commander WHERE IDPRODUIT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
        $stmt = $this->bdd->prepare("DELETE FROM produit WHERE IDPRODUIT = ?");
        $stmt->execute(
            array(
                $slug
            )
        );
    }

    public function getAllPlat()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM produit');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
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
    public function getAllCategorie()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM categorie');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getAllType()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM type');
        $stmt->execute(array());

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function findPlat($Nom)
    {
        $stmt = $this->bdd->prepare('SELECT NOMPRODUIT FROM produit WHERE NOMPRODUIT = ?');
        $stmt->execute(
            array(
                $Nom
            )
        );

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
    public function getPlat($id)
    {
        $stmt = $this->bdd->prepare('SELECT * FROM produit WHERE IDPRODUIT = ?');
        $stmt->execute(
            array(
                $id
            )
        );

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Panier\Models\Menu");
    }
}