<?php
ob_start();
$count = 0;
if (!isset($panier[0])) {
    echo '<h1>Panier Vide</h1>';
} else {
    ?>

    <section class="dashboard">
        <div class="topDashBoard">
            <h1><i class="fas fa-list-alt"></i> Panier :</h1>
        </div>
        <form action="/dashboard/modif/<?= $_SESSION['user']['id']; ?>" method="post">
            <table>
                <thead>
                    <tr>
                        <th>QTÉ</th>
                        <th>PLAT</th>
                        <th>PRIX/U</th>
                        <th>TOTAL</th>
                        <th><i class="fas fa-trash"></i></th>
                    </tr>
                </thead>

                <?php
                foreach ($panier as $paniers) {
                    ?>

                    <tbody>
                        <tr>
                            <td>
                                <input type="number" name="quantite[]" value="<?= $paniers->getQuantite(); ?>">
                                <input type="hidden" name="id[]" value="<?= $paniers->getIdCommande(); ?>">
                            </td>
                            <td>
                                <?= $paniers->getNomProduit(); ?>
                            </td>
                            <td>
                                <?= $paniers->getPrixProduit(); ?>
                            </td>
                            <td>
                                <?php
                                echo $paniers->getPrixProduit() * $paniers->getQuantite();
                                $count += $paniers->getPrixProduit() * $paniers->getQuantite();
                                ?>
                            </td>
                            <td>
                                <a href="delete/<?= $paniers->getIdCommande(); ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>


                    <?php
                }

                ?>
            </table>
            <p>
                total des achat =
                <?= $count; ?>
                €
            </p>
            <input type="submit" value="maj des modif">
            <a href="/dashboard/valide" class="btn">valider la command</a>
        </form>
    </section>
    <?php
}
$content = ob_get_clean();
require VIEWS . 'layout.php';