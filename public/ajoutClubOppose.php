<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets\football_pic2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles\style.css">
    <title>FootClub - Ajout / Modif joueur</title>
</head>

<body>
    <?php
    require '../autoloader.php';
    require '../include/header.php';
    require '../include/connexion_bdd.php';

    use App\Model\FormValidator;
    use App\Model\PlayerInsertion;

    $validator = new FormValidator();

    if (isset($_POST['addPlayer'])) {
        $validator->validateName($_POST['addPlayerName'], 'prénom du joueur');
        $validator->validateName($_POST['addPlayerLastName'], 'nom du joueur');
        $validator->validateDate($_POST['addPlayerBirthDate'], 'date de naissance');
        $validator->validateImage($_FILES['addPlayerPicture'], 'photo du joueur');

        // File Upload Handling
        if ($_FILES['addPlayerPicture']['error'] == 0) {
            $uploadDir = __DIR__.'/assets/'; // Specify the directory where you want to store images
            $originalFileName = $_FILES['addPlayerPicture']['name'];
            $originalFileName = $_FILES['addPlayerPicture']['name'];
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Generate a random number
            $randomNumber = rand(0, 100000);

            // Split the original file name and extension
            $fileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME);

            // Create a new file name with the random number between the name and extension
            $newFileName = $fileNameWithoutExtension . '_' . $randomNumber . '.' . $extension;

            $uploadFile = $uploadDir . $newFileName;



            // Check if the file already exists
            if (file_exists($uploadFile)) {
                $validator->errors['photo du joueur'] = '<p class="error">Ce fichier existe déjà.</p>';
            } else {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES['addPlayerPicture']['tmp_name'], $uploadFile)) {
                    // File successfully uploaded
                    $picture = $uploadFile;
                } else {
                    // Error in uploading the file
                    $validator->errors['photo du joueur'] = '<p class="error">Erreur lors de l\'upload du fichier.</p>';
                }
            }
        } elseif ($_FILES['addPlayerPicture']['error'] != 4) { // Error code 4 means no file was selected
            $validator->errors['photo du joueur'] = '<p class="error">Erreur lors du téléchargement du fichier.</p>';
        }

        if (!$validator->hasErrors()) {
            // Process the form data and insert it into the database, for example.
            // After successful processing, you can set a success message like $addPlayerSuccess.
    
            // Instantiate the PlayerInsertion class
            $playerInsertion = new PlayerInsertion($connexion);

            // Get form data
            $firstname = $_POST['addPlayerName'];
            $lastname = $_POST['addPlayerLastName'];
            $birthdate = $_POST['addPlayerBirthDate'];
    
            // Insert player data
            $playerId = $playerInsertion->insertPlayer($firstname, $lastname, $birthdate, $newFileName);

            if ($playerId) {
                echo "Player inserted successfully with ID: $playerId";
            } else {
                echo "Error inserting player data.";
            }
        }
    }
    ?>

    <div class="ajoutModifJoueur">
        <form action="#" method="POST" enctype="multipart/form-data">
            <h1>+ Ajouter un Club</h1>
            <!-- Display optional success message -->
            <?php echo isset($addPlayerSuccess) ? $addPlayerSuccess : ""; ?>

            <!-- Input fields and error messages using the $validator object -->
            <div class="sideBySide">
                <div class="side">
                    <label for="addPlayerName">Prénom du joueur : <span class="etoile">*</span></label>
                    <input type="text" name="addPlayerName" placeholder="ex: Franck"
                        value="<?php echo isset($_POST['addPlayerName']) ? htmlspecialchars($_POST['addPlayerName']) : ''; ?>">
                    <!-- Display error message for addPlayerName -->
                    <?php echo $validator->errors['prénom du joueur'] ?? ''; ?>
                </div>
                <div class="side">
                    <label for="addPlayerLastName">Nom du joueur : <span class="etoile">*</span></label>
                    <input type="text" name="addPlayerLastName" placeholder="ex: Ribéry"
                        value="<?php echo isset($_POST['addPlayerLastName']) ? htmlspecialchars($_POST['addPlayerLastName']) : ''; ?>">
                    <!-- Display error message for addPlayerLastName -->
                    <?php echo $validator->errors['nom du joueur'] ?? ''; ?>
                </div>
            </div>

            <label for="addPlayerBirthDate">Jour de naissance du joueur : <span class="etoile">*</span></label>
            <input type="date" name="addPlayerBirthDate"
                value="<?php echo isset($_POST['addPlayerBirthDate']) ? htmlspecialchars($_POST['addPlayerBirthDate']) : ''; ?>">
            <!-- Display error message for addPlayerBirthDate -->
            <?php echo $validator->errors['date de naissance'] ?? ''; ?>

            <label for="addPlayerPicture">Photo du joueur</label>
            <input type="file" name="addPlayerPicture">
            <!-- Display error message for addPlayerPicture -->
            <?php echo $validator->errors['photo du joueur'] ?? ''; ?>

            <input type="hidden" name="addPlayer">
            <input type="submit" value="Submit!">
        </form>
    </div>

</body>

</html>