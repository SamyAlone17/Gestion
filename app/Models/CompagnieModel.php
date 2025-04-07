<?php

namespace App\Models;

use CodeIgniter\Model;

class CompagnieModel extends Model
{
    protected $table = 'compagnie'; // Nom de la table dans la base de données
    protected $primaryKey = 'id_compagnie'; // Clé primaire de la table
    protected $useAutoIncrement = true;

    // Champs autorisés à être remplis
    protected $allowedFields = [ 'id_compagnie','nom_compagnie','code_compagnie','status_compagnie','creation_date','creation_time'];
 
    // retourner toutes les compagnies
    public function getCompagnies()
    {
        return $this->where('status_compagnie<>', '-1')->findAll();
    }


    public function getNameCompagnie($Compagnie) {
        return $this->db->table($this->table)
                        ->select('nom_compagnie')
                        ->where('id_compagnie', $Compagnie)
                        ->get()
                        ->getRow()
                        ->nom_compagnie;
    }
    // verifie s'il existe une compagnie ayant le nom inserer 
    public function getCompagnieByName($name)
    {
        return $this->where('nom_compagnie', $name)->first();
    }
    // creer une compagnie dans la base de donnée
    public function createCompagnie($compagnieData)
    {
        $this->insert($compagnieData);
        return $this->insertID();
    }

    public function getCompagnieById($id)
    {
        return $this->where('id_compagnie', $id)->first();
    }

    //  // Méthode pour mettre à jour une compagnie existant
    public function updateCompagnie($id, $userData)
    {
        return $this->update($id, $userData);
    }

    public function deleteCompagnie($id)
    {
       return $this->update($id, ['status_compagnie' => '-1']);
    }

    public function activatedCompagnie($id)
    {
        $this->update($id, ['status_compagnie' => '1']);
    }
    public function desactivateCompagnier($id)
    {
        $this->update($id, ['status_compagnie' => '0']);
    }
 
}
