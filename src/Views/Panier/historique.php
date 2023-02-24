<?php
ob_start();
$count = 0;
if (!isset($panier[0])) {
    echo '<h1>aucune commande passer</h1>';
} else {
    ?>

    <section class="dashboard">
        <div class="topDashBoard">
            <h1><i class="fas fa-list-alt"></i> historique des commande :</h1>
        </div>
        <div class="flex_row">
            <?php
            foreach ($panier as $paniers) {
                ?>
                <div class="viewListHistorique">
                    <div class="list">
                        <div class="top">
                            <h3>
                                Nom du plat :
                                <?= $paniers->getNomProduit(); ?>
                            </h3>
                            <p>quantite :
                                <?= $paniers->getQuantite(); ?>
                                / prix unitaire :
                                <?= $paniers->getPrixProduit(); ?> / prix total :
                                <?php
                                echo $paniers->getPrixProduit() * $paniers->getQuantite();
                                $count += $paniers->getPrixProduit() * $paniers->getQuantite();
                                ?>
                            </p>
                            <p>
                                commande passer le :
                                <?= $paniers->getDate(); ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <img src="/img/<?= $paniers->getIdProduit(); ?>.<?= $paniers->getExt(); ?>"
                            alt="img de <?= $paniers->getNomProduit(); ?>">
                    </div>
                </div>
                <?php
            }

            ?>
        </div>
        <p>
            total des achat =
            <?= $count; ?>
            €
        </p>
    </section>
    <?php
}
$content = ob_get_clean();
require VIEWS . 'layout.php';