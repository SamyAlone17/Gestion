<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table = 'produits'; // Nom de la table dans la base de données
    protected $primaryKey = 'id_produit'; // Clé primaire de la table
    protected $useAutoIncrement = true;

    // Champs autorisés à être remplis
    protected $allowedFields = [ 'nom_produit','description','prix','stock'];
 
    // retourner toute les Produits 
    public function getProduits()
    {
        return $this->findAll();
    }

    // verifie s'il existe une compagnie ayant le nom inserer 
    public function getProduitByName($name)
    {
        return $this->where('nom_produit', $name)->first();
    }
    //creation de Produit 
    public function CreateProduit($ProduitData){
        return $this->insert($ProduitData);
    }
}