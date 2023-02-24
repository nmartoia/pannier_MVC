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
                    <form action="/dashboard/plat" method="post" enctype="multipart/form-data">
                        <h3>ajout d'un plat</h3>
                        <div>
                            <label for="nom">Nom : </label>
                            <input type="text" id="nom" name="nom">
                        </div>
                        <div>
                            <label for="prix">Prix : </label>
                            <input type="text" id="prix" name="prix">
                        </div>
                        <div>
                            <label for="poids">Poids : </label>
                            <input type="number" id="poids" name="poids">
                        </div>
                        <div>
                            <label for="upoids">Unité du Poids : </label>
                            <input type="text" id="upoids" name="upoids">
                        </div>
                        <div>
                            <label for="origine">Origine : </label>
                            <select name="origine" id="origine">
                                <?php
                                foreach ($origine as $nats) {
                                    ?>
                                    <option value='<?php echo $nats->getIdOrigine(); ?>'> <?php echo $nats->getNomOrigine(); ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="categorie">Categorie : </label>
                            <select name="categorie" id="categorie">
                            <?php
                                foreach ($categorie as $categories) {
                                    ?>
                                    <option value='<?php echo $categories->getIdCategorie(); ?>'> <?php echo $categories->getNomCategorie(); ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="type">Type : </label>
                            <select name="type" id="type">
                            <?php
                                foreach ($type as $types) {
                                    ?>
                                    <option value='<?php echo $types->getIdType(); ?>'> <?php echo $types->getNomType(); ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="img">Image : </label>
                            <input class="white" type="file" name="img" id="img">
                        </div>
                        <div>
                            <p>Ingredient : </p>
                            <div class="flex_row list_ingredients">
                                <?php
                                foreach ($ingredient as $ingredients) {
                                    ?>
                                    <p>
                                        <input type="checkbox" name="ingredient[]"
                                            value="<?php echo $ingredients->getIdIngredient(); ?>">
                                        <?php echo $ingredients->getNomIngredient(); ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                        <input type="submit" name="button" value="envoyez">
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div class="list_ingredient">
                <div class="top">
                    <form action="/dashboard/ingredient" method="post">
                        <h3>ajout d'un ingrediant</h3>
                        <div>
                            <label for="nomIngrediant">Nom : </label>
                            <input type="text" id="nomIngrediant" name="nom">
                        </div>
                        <input type="submit" name="button" value="envoyez">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';