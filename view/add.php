
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

    if (!empty($_SESSION['erreur'])) {
        echo '<h2 class="angry-animate" style="color:red" role="alert">' . $_SESSION['erreur'] . '</h2>';
        $_SESSION['erreur'] = "";
    }

    ?>

</body>

</html>