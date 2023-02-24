<?php
namespace Panier\Models;

/** Class Panier **/
class Menu
{

    private $NOMORIGINE;
    private $IDORIGINE;
    private $NOMINGREDIENT;
    private $IDINGREDIENT;
    private $NOMPRODUIT;
    private $EXT;
    private $PRIXPRODUIT;
    private $POIDSPRODUIT;
    private $IDCATEGORIE;
    private $NOMCATEGORIE;
    private $IDTYPE;
    private $NOMTYPE;
    private $IDPRODUIT;
    private $INGREDIENTTAB = [];
    private $PLAT = [];
    private $QUANTITE;
    private $IDCOMMANDE;
    private $IDUSER;
    private $uniteDePoids;

    private $DATE;


    public function getNomOrigine()
    {
        return $this->NOMORIGINE;
    }

    public function getIdIngredient()
    {
        return $this->IDINGREDIENT;
    }
    public function getIdOrigine()
    {
        return $this->IDORIGINE;
    }
    public function getNomIngredient()
    {
        return $this->NOMINGREDIENT;
    }
    public function getNomProduit()
    {
        return $this->NOMPRODUIT;
    }
    public function getPrixProduit()
    {
        return $this->PRIXPRODUIT;
    }
    public function getPoidsProduit()
    {
        return $this->POIDSPRODUIT;
    }
    public function getNomCategorie()
    {
        return $this->NOMCATEGORIE;
    }
    public function getNomType()
    {
        return $this->NOMTYPE;
    }
    public function getIdProduit()
    {
        return $this->IDPRODUIT;
    }
    public function getIdType()
    {
        return $this->IDTYPE;
    }
    public function getExt()
    {
        return $this->EXT;
    }
    public function getIdCategorie()
    {
        return $this->IDCATEGORIE;
    }
    public function getQuantite()
    {
        return $this->QUANTITE;
    }
    public function getIdCommande()
    {
        return $this->IDCOMMANDE;
    }
    public function getUniteDePoids()
    {
        return $this->uniteDePoids;
    }

    public function getIdUser()
    {
        return $this->IDUSER;
    }

    public function getDate()
    {
        $date = date_create($this->DATE);
        return date_format($date, 'd/m/Y');
        //donne la date française si on veux la date americain suprimer le code si dessus et remplacer le par return $this->$date;
    }

    public function setIdUser(string $IDUSER)
    {
        $this->IDUSER = $IDUSER;
    }
    public function setDate(string $DATE)
    {
        $this->DATE = $DATE;
    }
    public function setIdOrigine(string $IDORIGINE)
    {
        $this->IDORIGINE = $IDORIGINE;
    }
    public function setNomOrigine(int $NOMORIGINE)
    {
        $this->NOMORIGINE = $NOMORIGINE;
    }

    public function setIdIngredient(string $IDINGREDIENT)
    {
        $this->IDINGREDIENT = $IDINGREDIENT;
    }
    public function setNomIngredient(string $NOMINGREDIENT)
    {
        $this->NOMINGREDIENT = $NOMINGREDIENT;
    }
    public function setNomProduit(string $NOMPRODUIT)
    {
        $this->NOMPRODUIT = $NOMPRODUIT;
    }
    public function setPrixProduit(string $PRIXPRODUIT)
    {
        $this->PRIXPRODUIT = $PRIXPRODUIT;
    }
    public function setPoidsProduit(string $POIDSPRODUIT)
    {
        $this->POIDSPRODUIT = $POIDSPRODUIT;
    }
    public function setNomCategorie(string $NOMCATEGORIE)
    {
        $this->NOMCATEGORIE = $NOMCATEGORIE;
    }
    public function setNomType(string $NOMTYPE)
    {
        $this->NOMTYPE = $NOMTYPE;
    }
    public function setIdProduit(string $IDPRODUIT)
    {
        $this->IDPRODUIT = $IDPRODUIT;
    }
    public function setExt(string $EXT)
    {
        $this->EXT = $EXT;
    }
    public function setIdType(string $IDTYPE)
    {
        $this->IDTYPE = $IDTYPE;
    }
    public function setIdCategorie(string $IDCATEGORIE)
    {
        $this->IDCATEGORIE = $IDCATEGORIE;
    }
    public function setQuantite(string $QUANTITE)
    {
        $this->QUANTITE = $QUANTITE;
    }
    public function setIdCommande(string $IDCOMMANDE)
    {
        $this->IDCOMMANDE = $IDCOMMANDE;
    }
    public function setUniteDePoids(string $uniteDePoids)
    {
        $this->uniteDePoids = $uniteDePoids;
    }
    public function plat()
    {
        $manager = new MenuManager();
        if (!$this->PLAT) {
            $this->PLAT = $manager->find();
        }

        return $this->PLAT;
    }
    public function allIngredient($id)
    {
        $manager = new MenuManager();
        if (!$this->INGREDIENTTAB) {
            $this->INGREDIENTTAB = $manager->AllIngredients($id);
        }

        return $this->INGREDIENTTAB;
    }
}