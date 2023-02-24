<?php
ob_start();
?>

<section class="homepage">
    <h1>Panier</h1>
    <p>une ambiance nocturne</p>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
