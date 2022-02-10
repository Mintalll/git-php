<?php session_start() ?>
<?php
$id = $_GET["id"]; 

require_once ("connect.php"); 
$query = $db->prepare("SELECT * FROM `produit` WHERE id = :id");
$query->bindValue(":id", $_GET["id"], PDO::PARAM_INT); // récupération de l'id depuis index.php
$query->execute();

// On recupere l'article
$article = $query->fetch();

?>

<?php 

if(!empty($_POST)){

if(isset(
  $_POST['produit'],
  $_POST['prix'],
  $_POST['nombre']) 
  && !empty($_POST["produit"]) 
  && !empty($_POST["prix"]) 
  && !empty($_POST["nombre"])) 
  {
    // connexion a la base de donnée
    require_once('connect.php');

    // on récupére les données du formuaire
    $produit = strip_tags($_POST['produit']);
    $prix = strip_tags($_POST['prix']);
    $nombre = strip_tags($_POST['nombre']);

      // on prepare la requete
      $sql = 'UPDATE `produit` SET `id` = :id, `produit` = :produit, `prix` = :prix, `nombre` = :nombre WHERE id = :ida LIMIT 1 ';
      // echo"<pre>";
      // var_dump($db);
      // echo"</pre>";
      // die();
      $query = $db->prepare($sql);

      // on defini les valeurs
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':produit', $produit, PDO::PARAM_STR);
      $query->bindValue(':prix', $prix, PDO::PARAM_STR);
      $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);
      $query->bindValue(':ida', $id, PDO::PARAM_INT);
      

      $query->execute();
      
      $_SESSION['message'] = "Le produit est modifié";
      header('Location: index.php');
      
  }else{
    
    $_SESSION['message'] = "Le formulaire est incomplet";
    
  }
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

    <h1>Update Du Produit N°<?php echo $_GET['id'];?></h1>

    <form method="post">
        <div class="mb-3">
            <label for="produit" class="form-label">Nom du Produit</label>
            <input type="text" class="form-control" name="produit" value="<?= $article["produit"];?>">
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="text" class="form-control" name="prix" value="<?= $article["prix"];?>">
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Quantité</label>
            <input type="number" class="form-control" name="nombre" value="<?= $article["nombre"];?>">
        </div>

        <button type="submit" class="btn btn-primary" name="Envoyer"><span>Envoyer</span></button>
        <a href="index.php"><button type="button" class="btn btn-primary"><span>Liste des Produits</span></button></a>
    </form>
    
</body>
</html>

