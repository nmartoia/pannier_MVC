<?php
ob_start();

?>

<section class="error">
    <h1>404 :(</h1>
    <p>page not found</p>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
