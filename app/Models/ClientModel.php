<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients'; // Nom de la table dans la base de données
    protected $primaryKey = 'id_client'; // Clé primaire de la table
    protected $useAutoIncrement = true;

    // Champs autorisés à être remplis
    protected $allowedFields = [ 'nom','email','telephone','adresse'];
 
    // retourner toute les Clients 
    public function getClients()
    {
        return $this->findAll();
    }

    // verifie s'il existe une compagnie ayant le nom inserer 
    public function getClientByName($name)
    {
        return $this->where('nom', $name)->first();
    }
    //creation de client 
    public function CreateClient($clientData){
        return $this->insert($clientData);
    }
}