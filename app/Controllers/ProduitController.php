<?php

namespace App\Controllers;
use App\Models\ProduitModel;

class ProduitController extends BaseController
{
    public function index()
    {
        $model = new ProduitModel();
        $data['produits'] = $model->getProduits(); // Récupère tous les compagnies

        return view('produit/list_produit',$data); // Affiche la vue avec la liste des compagnies
    }


    public function store(){
        // Vérifie si le formulaire a été soumis
        $erros=Null;
        $ProduitData = [
            'nom_produit' => $this->request->getPost('nom_produit'),
            'description' => $this->request->getPost('description'),
            'prix' => $this->request->getPost('prix'),
            'stock' => $this->request->getPost('stock'),
            
        ];
        $datas=array(
            'Produit'=>$ProduitData,
            'erros'=>$erros
        );

        if ($this->request->getMethod() === 'post') {

            $rules = [
            'nom_produit' => 'required',
            'prix' => 'required'
            ];
            $messages = [
                'nom' => [
                    'required' => 'Le nom du Produit est requis.'
                ],
                'prix' => [
                    'required' => 'Prix du Produit est requis.'
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
            $ProduitModel = new ProduitModel();
            
            // Vérifier si la companie creer exeiste  déjà
            if ($ProduitModel->getProduitByName($ProduitData['nom_produit'])) {
                $erros="le Produit existe deja ";
                $data=array(
                    "status"=>400,
                    "error"=>$erros
                );
                return json_encode($datas);
            }

            // Enregistrer la compagnie dans la base de données
            $ProduitModel->CreateProduit($ProduitData);
            $erros="le Produit créer avec succes ";
            $data=array(
                "status"=>200,
                "error"=>$erros,
                "redirect"=>base_url("/admin/Produit")
            );
            return json_encode($data);
            
           }
    }

}