<?php

namespace Panier\Controllers;

use Panier\Models\MenuManager;
use Panier\Validator;

/** Class UserController **/
class MenuController
{
    private $manager;
    private $validator;

    public function __construct()
    {
        $this->manager = new MenuManager();
        $this->validator = new Validator();
    }

    public function index()
    {
        require VIEWS . 'Panier/homepage.php';
    }
    public function commande()
    {
        $filtres = $this->manager->find();
        $filtres2 = $this->manager;
        require VIEWS . 'Panier/shearch.php';
    }
    public function panier()
    {
        $panier = $this->manager->panier();
        require VIEWS . 'Panier/panier.php';
    }
    public function create()
    {
        $ingredient = $this->manager->getAllIngredient();
        $origine = $this->manager->getAllOrigine();
        $formateur2 = $this->manager;
        require VIEWS . 'Panier/filtre.php';
    }
    public function backoffice()
    {
        if (isset($_SESSION['user']['permissions']) && $_SESSION['user']['permissions'] == 1) {
            $ingredient = $this->manager->getAllIngredient();
            $origine = $this->manager->getAllOrigine();
            $categorie = $this->manager->getAllCategorie();
            $type = $this->manager->getAllType();
            require VIEWS . 'Panier/backoffice.php';
        } else {
            $_SESSION["error"]['name'] = "vous n'avez pas les droit";
            header("Location: /login");
        }
    }
    public function backofficeupdate()
    {
        if (isset($_SESSION['user']['permissions']) && $_SESSION['user']['permissions'] == 1) {
            $ingredient = $this->manager->getAllIngredient();
            $origine = $this->manager->getAllOrigine();
            $categorie = $this->manager->getAllCategorie();
            $produit = $this->manager->getAllPlat();
            $type = $this->manager->getAllType();
            require VIEWS . 'Panier/backofficeupdate.php';
        } else {
            $_SESSION["error"]['name'] = "vous n'avez pas les droit";
            header("Location: /login");
        }
    }
    public function backofficesupp()
    {
        if (isset($_SESSION['user']['permissions']) && $_SESSION['user']['permissions'] == 1) {
            $ingredient = $this->manager->getAllIngredient();
            $origine = $this->manager->getAllOrigine();
            $categorie = $this->manager->getAllCategorie();
            $produit = $this->manager->getAllPlat();
            $type = $this->manager->getAllType();
            require VIEWS . 'Panier/backofficedelet.php';
        } else {
            $_SESSION["error"]['name'] = "vous n'avez pas les droit";
            header("Location: /login");
        }
    }
    public function valide()
    {
        if (!isset($_SESSION['user']['id'])) {
            //si il n'ai pas co
            $_SESSION["error"]['name'] = "vous n'ete pas connecter";

        } else {
            $paniers = $this->manager->recupPanier($_SESSION['user']['id']);
            foreach ($paniers as $panier) {
                $this->manager->valide($panier);
            }
            $this->manager->deleteAll($_SESSION['user']['id']);
        }
        header("Location: /");
    }
    public function store()
    {
        $_SESSION['old'] = $_POST;
        $_SESSION['olds'] = $_POST;
        header("Location:/dashboard/commande");
    }
    public function historique()
    {
        $panier = $this->manager->historique();
        require VIEWS . 'Panier/historique.php';
    }
    public function update($slug)
    {
        if (!isset($_SESSION['user']['id'])) {
            //si il n'ai pas co
            $_SESSION["error"]['name'] = "vous n'ete pas connecter";
            header("Location: /");
        } else if ($_SESSION['user']['id'] != $slug) {
            //si il n'ai pas co sur le bon compte
            $_SESSION["error"]['name'] = "vous n'ete pas connecter sur le bon compte";
            header("Location: /");
        } else {
            $error = 0;
            $quantite = $_POST['quantite'];
            for ($j = 0; $j < sizeof($quantite); $j++) {
                if ($_POST['quantite'][$j] < 0 || $_POST['quantite'][$j] == '') {
                    $error++;
                    //si la quantite et plus petit que 0
                }
            }
            if ($error > 0) {
                //si le compteur et plus grand que 0 on a une erreur
                $_SESSION["error"]['name'] = "une des quantite et inferieur a 0";
                header("Location: /dashboard/panier");
            } else {
                for ($j = 0; $j < sizeof($quantite); $j++) {
                    $this->manager->update($slug, $quantite[$j], $_POST['id'][$j]);
                }
                header("Location:/dashboard/panier");
            }
        }
    }
    public function plat()
    {
        $prix = str_replace(",", '.', $_POST['prix']);
        if ($_POST['nom'] != "" && $_POST['prix'] != "" && $_POST['poids'] != "" && isset($_POST['ingredient']) && $_FILES['img']['name'] != "") {
            if (!(float) $prix || !(int) $_POST['poids']) {
                //si on ne peux pas les convertire en chiffre
                $_SESSION["error"]['name'] = "il y a des lettre dans le champ prix ou   poids";
            } else if ($this->manager->findPlat($_POST['nom'])) {
                $_SESSION["error"]['name'] = "Nom dupliquer";
            } else {
                $uuid = uniqid();
                $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $chemain = 'img/' . $uuid . '.' . $ext;
                move_uploaded_file($_FILES['img']['tmp_name'], $chemain);
                $this->manager->insertPlat($uuid, $_POST['nom'], $_POST['prix'], $_POST['poids'], $_POST['origine'], $_POST['categorie'], $_POST['type'], $ext, $_POST['upoids']);
                for ($j = 0; $j < sizeof($_POST['ingredient']); $j++) {
                    $this->manager->insertIngredient($uuid, $_POST['ingredient'][$j]);
                }
                $_SESSION["error"]['name'] = "produit creer";
            }
        } else {
            //si un champ est vide
            $_SESSION["error"]['name'] = "un champ est vide";
        }
        header("Location: /dashboard/backoffice");

    }
    public function delete($slug)
    {

        $this->manager->delete($slug);
        header("Location: /dashboard/panier");
    }
    public function ingrediantDelet($slug)
    {

        $this->manager->deletIngrediant($slug);
        header("Location: /dashboard/backoffice/supp");
    }
    public function ingrediantModif()
    {

        $this->manager->modifIngrediant();
        header("Location: /dashboard/backoffice/update");
    }
    public function platDelet($slug, $ext)
    {
        $this->manager->deletPlat($slug);
        unlink('img/' . $slug . "." . $ext);
        header("Location: /dashboard/backoffice/supp");
    }
    public function ajout()
    {
        if ($_POST["quantiter"] > 0) {
            $commander = $this->manager->findCommande();
            if ($commander) {
                $this->manager->updatePanier();
            } else {
                $this->manager->ajout();
            }
        } else {
            $_SESSION['error']["name"] = "0 quantité choisi";
        }
        header("Location: /dashboard/commande");
    }
    public function ingredient()
    {
        if ($_POST["nom"] != "") {
            $uuid = uniqid();
            $this->manager->ingredient($uuid, $_POST['nom']);
            $_SESSION['error']["name"] = "Ingredient ajouter";
        } else {
            $_SESSION['error']["name"] = "pas de nom choisie";
        }
        header("Location: /dashboard/backoffice");
    }
}