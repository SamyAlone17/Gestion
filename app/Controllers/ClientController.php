<?php

namespace App\Controllers;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        $model = new ClientModel();
        $data['clients'] = $model->getClients(); // Récupère tous les compagnies

        return view('client/list_client',$data); // Affiche la vue avec la liste des compagnies
    }


    public function store(){
        // Vérifie si le formulaire a été soumis
        $erros=Null;
        $clientData = [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'telephone' => $this->request->getPost('telephone'),
            'adresse' => $this->request->getPost('adresse'),
            
        ];
        $datas=array(
            'client'=>$clientData,
            'erros'=>$erros
        );

        if ($this->request->getMethod() === 'post') {

            $rules = [
            'nom' => 'required|min_length[8]',
            'telephone' => 'required|min_length[4]'
            ];
            $messages = [
                'nom' => [
                    'required' => 'Le nom du client est requis et comporte quatre au moins 4 lettre.'
                ],
                'telephone' => [
                    'required' => 'telephone du client est requis.'
                ]
            ];

            if (!$this->validate($rules,$messages)) {
                // Afficher les erreurs de validation

                $erros=$this->validator->getErrors();
                $data=array(
                    "status"=>401,
                    "error"=>$erros
                );
                return json_encode($data);

            }
            // Récupérer les données du formulaire
          

            // Créer une instance du modèle Compagnie
            $ClientModel = new ClientModel();
            
            // Vérifier si la companie creer exeiste  déjà
            if ($ClientModel->getClientByName($clientData['nom'])) {
                $erros="le client existe deja ";
                $data=array(
                    "status"=>400,
                    "error"=>$erros
                );
                return json_encode($datas);
            }

            // Enregistrer la compagnie dans la base de données
            $ClientModel->CreateClient($clientData);
            $erros="le client créer avec succes ";
            $data=array(
                "status"=>200,
                "error"=>$erros,
                "redirect"=>base_url("/admin/client")
            );
            return json_encode($data);
            
           }
    }

}
