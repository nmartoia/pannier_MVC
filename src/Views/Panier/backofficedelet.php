<?php
ob_start();
?>

<section class="create">
    <h1><i class="fas fa-list-alt"></i> back office :</h1>
    <p class="error">
        <?php
        if (isset($_SESSION['error']["name"])) {
            echo $_SESSION['error']["name"];
        }
        ?>
    </p>
    <div class="space">
        <div>
            <div class="list_ingredient">
                <div class="top">
                    <h3>supprimer un plat</h3>
                    <div class="flex_column">
                        <?php
                        foreach ($produit as $plat) {
                            ?>
                            <p>
                                <a href="plat/<?php echo $plat->getIdProduit(); ?>/<?php echo $plat->getExt(); ?>/delet">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php echo $plat->getNomProduit(); ?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="list_ingredient">
                <div class="top">
                    <h3>supprimer un ingrediant</h3>
                    <div class="flex_column">
                        <?php
                        foreach ($ingredient as $ingredients) {
                            ?>
                            <p>
                                <a href="ingrediant/<?php echo $ingredients->getIdIngredient(); ?>/delet">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php echo $ingredients->getNomIngredient(); ?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';