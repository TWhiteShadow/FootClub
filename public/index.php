<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/assets/football_pic2.png" type="image/x-icon">
    <link rel="stylesheet" href="public/styles/style.css">
    <title>FootClub - Accueil</title>
</head>

<body>
    <?php
    require '../include/connexion_bdd.php';
    require '../autoloader.php';
    require '../include/header.php';
    ?>

    <section class="infos">
        <?php

        // use App\Database\Database;
        use App\Model\PlayerRepository;

        // Database::connect();

        // Instantiate the PlayerRepository class
        $playerRepository = new PlayerRepository($connexion);

        // Get all players from the database
        $allPlayers = $playerRepository->getAllPlayers();

        // $allPlayers is an array of Player objects containing player data from the database
        ?>
        <div class="cardContainer">
            <?php
            foreach ($allPlayers as $player) { ?>
                <div class="card">
                    <img src="public/assets/<?= $player->getPhoto() ?>" alt="<?= $player->getName()?>'s Picture">

                    <h1>
                        <?= $player->getName() . " " . $player->getLastName() ?>
                    </h1>

                    <span class="birthDate">Date of Birth :
                        <?= $player->getDateDeNaissance()->format('Y-m-d') ?>
                    </span>
                </div>
            <?php } ?>
        </div>

    </section>
</body>

</html>