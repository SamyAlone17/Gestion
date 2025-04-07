<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandeModel extends Model
{
    protected $table = 'commandes'; // Nom de la table dans la base de données
    protected $primaryKey = 'id_commande'; // Clé primaire de la table
    protected $useAutoIncrement = true;

    // Champs autorisés à être remplis
    protected $allowedFields = [ 'id_commande','quantite','date_commande'];
 
    // retourner toute les Clients 
    public function getCommande()
    {
        return $this->findAll();
    }

    // verifie s'il existe une compagnie ayant le nom inserer 
    public function getCommandeById($id)
    {
        return $this->where('id_commande', $id)->first();
    }
    //creation de client 
    public function CreateCommande($commandeData){
        return $this->insert($commandeData);
    }
}