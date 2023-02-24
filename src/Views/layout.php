<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>— Panier —</title>
    <link rel="icon" href="/avatar.ico">
    <script src="https://kit.fontawesome.com/affdc3fe7d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="/" class="logo">LOGO</a>
            <div class="hoverLink">
                <a href="/" class="icon"><i class="fas fa-home"></i></a>
                <p class="hidden">Accueil</p>
            </div>
            <?php
            if (!isset($_SESSION["user"]["username"])) {
            ?>
                <div class="hoverLink">
                    <a href="/login" class="icon"><i class="fas fa-user-tie"></i></a>
                    <p class="hidden">Login</p>
                </div>
            <?php
            } else {

            ?>

                <div class="hoverLink">
                    <a href="/dashboard/nouveau" class="icon"><i class="fa-solid fa-bars"></i></a>
                    <p class="hidden">Menu</p>
                </div>
                <div class="hoverLink">
                    <a href="/dashboard" class="icon"><i class="fa-solid fa-cart-shopping"></i></a>
                    <p class="hidden">panier</p>
                </div>

                <div class="hoverLink">
                    <a href="/logout" class="icon"><i class="fas fa-power-off"></i></a>
                    <p class="hidden">Logout</p>
                </div>
            <?php
            }
            ?>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
