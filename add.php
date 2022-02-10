<?php

    // Ouverture d'une Session
    session_start();

    if($_POST){
        if(isset($_POST["produit"]) && !empty($_POST["produit"]) &&
            isset($_POST["prix"])  && !empty($_POST["prix"]) &&
            isset($_POST["nombre"]) && !empty($_POST["nombre"]))
        {
                // On inclut la connexion à la base
                require_once('connect.php');

                // On nettoie les données envoyées
                $produit = strip_tags($_POST["produit"]);
                $prix = strip_tags($_POST["prix"]);
                $nombre = strip_tags($_POST["nombre"]);

                $sql = 'INSERT INTO `produit` (`produit`, `prix`, `nombre`) VALUES (:produit, :prix, :nombre);';

                // On prépare la requête
                $query = $db->prepare($sql);

                $query->bindValue(':produit', $produit, PDO::PARAM_STR);
                $query->bindValue(':prix', strval($prix), PDO::PARAM_STR);
                $query->bindValue(':nombre', $nombre, PDO::PARAM_STR);

                // On exécute la requête
                $query->execute();

                $_SESSION['message'] = "Produit Ajouté";

                require_once('close.php');

                header('Location: index.php');    
        } else {
            $_SESSION['erreur'] = "Erreur, vous n'avez pas rempli tout le formulaire !!!";
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <form action="add.php" method="post">

        <div class="mb-3">

            <label for="produit" class="form-label">Nom du Produit</label>

            <input type="text" class="form-control" name="produit">

        </div>

        <div class="mb-3">

            <label for="prix" class="form-label">Prix</label>

            <input type="number" class="form-control" name="prix">

        </div>

        <div class="mb-3">

            <label for="nombre" class="form-label">Quantité</label>

            <input type="number" class="form-control" name="nombre">

        </div>

        <button type="submit" class="btn btn-primary" name="Envoyer"><span>Envoyer</span></button>
        <a href="index.php"><button type="button" class="btn btn-primary"><span>Liste des Produits</span></button></a>
        
    </form>

    <?php

        if(!empty($_SESSION['erreur'])){
                echo'<h2 class="angry-animate" style="color:red" role="alert">'.$_SESSION['erreur'].'</h2>';
                $_SESSION['erreur'] = "";
        }

    ?>
    
</body>
</html>
