<?php

class Model {
    private int $id = 0;
    private string $produit = "";
    private float $prix = 0;
    private int $nombre = 0;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of produit
     */ 
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set the value of produit
     *
     * @return  self
     */ 
    public function setProduit(string $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix(float $prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    private function connect() {
        try {
            // Connexion à la base
            $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
            $db->exec('SET NAMES "UTF8"');
            return $db;
        } catch (PDOException $e) {
            echo "Erreur : ". $e->getMessage();
            die();
        }
    }

    public function view() {
        // On démarre une session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        $sql = 'SELECT * FROM `produit`';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On stocke le résulat dans un tableau associatif
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function add() {
        // Ouverture d'une Session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

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

        header('Location: index.php');    
    }
}