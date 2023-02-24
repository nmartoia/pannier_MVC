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
                    <h3>modification du nom d'un ingrediant</h3>
                    <form action="ingrediant/modif" method="post">
                        <select name="Ingrediant">
                            <?php
                            foreach ($ingredient as $ingredients) {
                                ?>
                                <option value="<?php echo $ingredients->getIdIngredient(); ?>"><?php echo $ingredients->getNomIngredient(); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="text" required name="newName">
                        <input type="submit" value="envoyez">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';