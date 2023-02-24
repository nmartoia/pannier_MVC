<?php

use Panier\Models\Formateur;

ob_start();
?>

<section class="create">
    <h1><i class="fas fa-list-alt"></i> Création Paniers :</h1>

    <div>
        <div class="list">
            <div class="top">
                <form action="/dashboard/nouveau" method="post">

                    <div class="flex_row">
                        <label for="form">ingredients :</label>
                        <select name="form" id="form">
                            <option value="">tous</option>
                            <?php
                            foreach ($ingredient as $ingredients) {
                            ?>
                                <option value='<?php echo $ingredients->getIdIngredient(); ?>'><?php echo $ingredients->getNomIngredient(); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="flex_row">
                        <label for="plat">liste des plats contenant le mot suivant : </label>
                        <input type="text" id="plat" name="plat">
                    </div>

                    <p>Liste des plats par fouchette de prix, par origine et par origine de plat</p>
                    <div class="flex_row">
                        <label for="prixmini">Choisir prix mini : </label>
                        <input type="number" id="prixmini" name="prixmini">
                    </div>
                    <div class="flex_row">
                        <label for="prixmaxi">Prix maxi : </label>
                        <input type="number" id="prixmaxi" name="prixmaxi">
                    </div>
                    <div class="flex_row">
                        <label for="nation">origine du plat:</label>
                        <select name="nat" id="nation">
                        <option value="">tous</option>
                            <?php
                            foreach ($origine as $nats) {
                            ?>
                                <option value='<?php echo $nats->getIdOrigine(); ?>'> <?php echo $nats->getNomOrigine(); ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <span class="error"><?php echo error("name"); ?></span>
                    <button type="submit" name="button"><i class="fas fa-plus"></i></button>
                </form>
            </div>
        </div>


    </div>

</section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
