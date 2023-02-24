<?php

use Panier\Models\Menu;

ob_start();
$count = 0;
?>

<section class="dashboard" style="flex:initial;">
    <div class="topDashBoard">
        <h1><i class="fas fa-list-alt"></i> plats trouver :</h1>
        <p class="error">
            <?php
            if (isset($_SESSION['error']["name"])) {
                echo $_SESSION['error']["name"];
            }
            ?>
        </p>
    </div>
    <div class="flex_row centers">
        <?php
        foreach ($filtres as $filtre) {
            $count++
                ?>
            <div class="viewList">
                <div class="top">
                    <p><span class="titre">
                            <?= $filtre->getNomProduit(); ?>
                        </span>
                        <?= $filtre->getNomType(); ?>
                    </p>
                    <p>prix :
                        <?= $filtre->getPrixProduit(); ?>€
                        <?= $filtre->getNomCategorie(); ?> de
                        <?= $filtre->getPoidsProduit(); ?>
                        <?= $filtre->getUniteDePoids(); ?>
                    </p>
                    <p>Origine :
                        <?= $filtre->getNomOrigine() ?>
                    </p>
                    <p>
                        Ingrédients :
                        <?php
                        foreach ($filtres2->AllIngredients($filtre->getIdProduit()) as $filtre2) {
                            ?>
                            <?= $filtre2->getNomIngredient(); ?>
                            <?php
                        }
                        ?>
                    </p>

                </div>
                <div>
                    <form action="/dashboard/commander" method="post" class="form">
                        <div class="flex_row">
                            <p> quantité : </p>
                            <input type="hidden" name="id" value="<?= $filtre->getIdProduit(); ?>">
                            <input type="number" name="quantiter">
                        </div>
                        <input type="submit">
                    </form>
                </div>

            </div>
            <div class="viewListImg">
                <img src="/img/<?= $filtre->getIdProduit(); ?>.<?= $filtre->getExt(); ?>"
                    alt="img d'une <?= $filtre->getNomProduit(); ?>">
            </div>
            <?php
        }
        echo "</div><h2>" . $count . " plat trouver</h2>";
        ?>

</section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';