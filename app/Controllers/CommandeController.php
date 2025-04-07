<?php

namespace App\Controllers;
use App\Models\CommandeModel;

class CommandeController extends BaseController
{
    // Voir toutes les commandes
    public function index()
    {
        $model = new CommandeModel();
        $data['commandes'] = $model->getCommande(); // Récupère tous les compagnies

        return view('commande/list_commande',$data); // Affiche la vue avec la liste des compagnies
    }

    public function show($id)
    {
        $commandeModel = new CommandeModel();
        $commande = $commandeModel->getcommandeById($id);

        return view('commande/list_commande');
    }

   
}