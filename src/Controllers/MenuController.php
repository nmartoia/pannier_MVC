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

    public function create()
    {
        $ingredient = $this->manager->getAllIngredient();
        $origine = $this->manager->getAllOrigine();
        $formateur2 = $this->manager;
        require VIEWS . 'Panier/create.php';
    }

    public function store()
    {
        $_SESSION['old'] = $_POST;
        $this->manager->find();
        header("Location:/dashboard/nouveau");
    }
    public function update($slug)
    {
        $dateinf = 0;
        if (!isset($_POST['formateurs'])) {
            //si aucun formateurs est cocher on a une erreur
            $_SESSION["error"]['name'] = "aucun formateur choisi";
            header("Location: /dashboard/" . $slug);
        } else {
            $formateurs_tb = $_POST['formateurs'];
            for ($j = 0; $j < sizeof($formateurs_tb); $j++) {
                if ($_POST['datedeb'] > $_POST['datefin']) {
                    $dateinf++;
                    //si des date de fin et plus avent le debut le compteur augment
                }
            }
            if ($dateinf > 0) {
                //si le compteur et plus grand que 0 on a une erreur
                $_SESSION["error"]['name'] = "une date de debut et apres la date de fin";
                header("Location: /dashboard/" . $slug);
            } else if (htmlspecialchars($_POST['nom']) != $_POST['nom'] || htmlspecialchars($_POST['prenom']) != $_POST['prenom']) {
                //si ya des caracteur speciaux on a une erreur
                $_SESSION["error"]['name'] = "caracter speciaux dans le nom ou prenom";
                header("Location: /dashboard/" . $slug);
            } else if ($_POST['nom'] == '' || $_POST['prenom'] == '') {
                //si un des champ est vide on a une erreur
                $_SESSION["error"]['name'] = "nom ou prenom vide";
                header("Location: /dashboard/" . $slug);
            } else if (strlen($_POST['nom']) > 20 || strlen($_POST['prenom']) > 20) {
                //si un des champ a une taille plus grand que 20 on a une erreur
                $_SESSION["error"]['name'] = "nom ou prenom plus grand que 20";
                header("Location: /dashboard/" . $slug);
            } else {
                $this->manager->update($slug);
                $this->manager->deleteupdate($slug);

                for ($j = 0; $j < sizeof($formateurs_tb); $j++) {
                    $date = date_create($_POST['datedeb'][$j]);
                    $date1 = date_create($_POST['datefin'][$j]);
                    $this->manager->insertupdate($slug, $formateurs_tb[$j], date_format($date, 'Y-m-d'), date_format($date1, 'Y-m-d'));
                }
                //si tous va bien message pour dire que la modif a bien eter fais
                header("Location:/dashboard/");
            }
        }
    }

    public function delete($slug)
    {

        $this->manager->delete($slug);
        header("Location: /dashboard");
    }


    public function show($slug)
    {
        $nat = $this->manager->getAllIngredient();
        $origine = $this->manager->getAllOrigine();
        $formateur = $this->manager->getAllFormateur();
        $formateur2 = $this->manager;
        $Panier = $this->manager->find($slug);
        if (!$Panier) {
            header("Location: /error");
        }
        require VIEWS . 'Panier/show.php';
    }
    public function showAll()
    {
        $formateurTab = $this->manager->getAll();
        if (!$formateurTab) {
            header("Location: /error");
        }
        require VIEWS . 'Panier/index.php';
    }
}
