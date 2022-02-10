<?php
if(!empty($_POST)){
    if(isset($_POST['produit'],
    $_POST['prix'],
    $_POST['nombre'])
    && !empty($_POST['produit'])
    && !empty($_POST['prix'])
    && !empty($_POST['nombre']))
    {
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $produit = strip_tags($_POST["produit"]);
        $prix = strip_tags($_POST["prix"]);
        $nombre = strip_tags($_POST["nombre"]);

        $sql = 'UPDATE `produit` SET `produit` = :produit, `prix` = :prix, `nombre` = :nombre WHERE id = :id;';

        // On prépare la requête
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

        // On exécute la requête
        $query->execute();

        $_SESSION['message'] = "Produit Modifié";

        header('Location: index.php');    

    } else {
        $_SESSION['erreur'] = "Erreur, vous n'avez pas rempli tout le formulaire !!!";
    }
    require_once('close.php');
}

if($_GET){
    session_start();

    $id = $_GET["id"];

    // On inclut la connexion à la base
    require_once('connect.php');

    // $sql = 'SELECT * FROM `produit` WHERE id = :id';

    // On prépare la requête
    $query = $db->prepare('SELECT * FROM `produit` WHERE id = :id');

    $query->bindValue(':id', $_GET["id"], PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On stocke le résulat dans un tableau associatif
    $article = $query->fetch();

    require_once('close.php');
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

    <h1>Update Du Produit N°<?php echo $id;?></h1>

    <form method="post">
        <div class="mb-3">
            <label for="produit" class="form-label">Nom du Produit</label>
            <input type="text" class="form-control" id="produit" name="produit" value="<?= $article["produit"];?>">
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?= $article["prix"];?>">
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Quantité</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $article["nombre"];?>">
        </div>

        <button type="submit" class="btn btn-primary"><span>Envoyer</span></button>
        <a href="index.php"><button type="button" class="btn btn-primary"><span>Liste des Produits</span></button></a>
    </form>
    
</body>
</html>