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
    <?php

        if($_SESSION['message']){
            echo('<h2 class="angry-animate" style="color:green" role="alert">'.$_SESSION['message'].'</h2>');
            $_SESSION['message'] = " ";
        }

    ?>
    
    <table class="table table-info table-striped ">

        <thead>

            <tr>

                <th scope="col">ID</th>

                <th scope="col">Produit</th>

                <th scope="col">Prix</th>

                <th scope="col">Quantité</th>

                <th scope="col">Actions</th>

            </tr>

        </thead>

        <tbody>

            <?php
            // On boucle sur la variable result
            foreach($result as $produit) {
                // var_dump($produit);
            ?>

                <tr>

                    <td><?= $produit['id'] ?></td>
                    <td><?= $produit['produit'] ?></td>
                    <td><?= $produit['prix'] ?></td>
                    <td><?= $produit['nombre'] ?></td>
                    <td><a href="update.php?id=<?= $produit['id']?>"><button type="button" class="btn btn-primary"><span>Modifier un Produit</span></button></a></td>
                    <td><a href="delete.php?id=<?= $produit['id']?>"><button type="button" class="btn btn-primary"><span>Supprimer un Produit</span></button></a></td>

                </tr>
            
            <?php
            }
            ?>

        </tbody>
    </table>

    <a href="index.php?action=add"><button type="button" class="btn btn-primary"><span>Ajouter un Produit</span></button></a>

</body>
</html>