<?php
    use App\Database\PlayerDatabase;
    require '../src/views/header.html.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets\football_pic2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles\style.css">
    <title>ClubFoot | Accueil</title>
</head>

<body>
    <section class="infos">
        <div class="cardContainer">
            <?php
            foreach ($allPlayers as $player) { ?>
                <div class="card">

                    <img src="assets/<?= $player->getPhoto() ?>" alt="<?= $player->getFirstName()?><?= $player->getLastName()?>">
                    <h1>
                        <?= $player->getFirstName() . " " . $player->getLastName() ?>
                    </h1>

                    <span class="birthDate">Né le :
                        <?= $player->getbirthDate()->format('Y-m-d') ?>
                    </span>
                </div>
            <?php } ?>
        </div>

    </section>
</body>

</html>