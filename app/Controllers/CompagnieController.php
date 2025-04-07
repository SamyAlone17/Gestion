<?php

namespace App\Controllers;

use App\Models\CompagnieModel;
use CodeIgniter\Controller;

class CompagnieController extends Controller
{
    // Méthode pour afficher tous les compagnies
    public function index()
    {
        $model = new CompagnieModel();
        $data['compagnies'] = $model->getCompagnies(); // Récupère tous les compagnies

        return view('compagnie/index_compagnie',$data); // Affiche la vue avec la liste des compagnies
    }

    public function store(){
        // Vérifie si le formulaire a été soumis
        $erros=Null;
        $compagnieData = [
            'status_compagnie' => '0', // Par défaut, l'utilisateur est activé
            'nom_compagnie' => $this->request->getPost('nom_compagnie'),
            'code_compagnie' => $this->request->getPost('code_compagnie'),
            
        ];
        $datas=array(
            'compagnie'=>$compagnieData,
            'erros'=>$erros
        );

        if ($this->request->getMethod() === 'post') {

            $rules = [
            'nom_compagnie' => 'required|min_length[8]',
            'code_compagnie' => 'required|min_length[4]'
            ];
            $messages = [
                'code_compagnie' => [
                    'required' => 'Le code compagnie est requis et comporte quatre au moins lettre.'
                ],
                'nom_compagnie' => [
                    'required' => 'Lalias de la compagnie est requis.'
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
            $compagnieModel = new CompagnieModel();
            
            // Vérifier si la companie creer exeiste  déjà
            if ($compagnieModel->getCompagnieByName($compagnieData['nom_compagnie'])) {
                $erros="la compagnie existe deja ";
                $data=array(
                    "status"=>400,
                    "error"=>$erros
                );
                return json_encode($datas);
            }

            // Enregistrer la compagnie dans la base de données
            $compagnieModel->createCompagnie($compagnieData);
            $erros="La compagnie créer avec succes ";
            $data=array(
                "status"=>200,
                "error"=>$erros,
                "redirect"=>base_url("/admin/compagnie")
            );
            return json_encode($data);
            
           }
    }



        public function get_compagnieBYid($id)
        {

            $compagnieModel = new CompagnieModel();

            $data = $compagnieModel->getCompagnieById($id);

            // Rediriger vers la page d'accueil ou la page de connexion
            $data=array(
                "status"=>200,
                "data"=> $data
            );

            return json_encode($data);
        }

       
   public function update()
{
    $compagnieModel = new CompagnieModel();

    $companyId = $this->request->getVar('id_compagnie');
    $errors = null;

    $compagnieData = [
        'last_update_date' => date('Y-m-d H:i:s'), // Ajout de la date de dernière mise à jour
        'nom_compagnie' => $this->request->getPost('nom_compagnie'),
        'code_compagnie' => $this->request->getPost('code_compagnie'),
    ];

    $data = [
        'compagnie' => $compagnieData,
        'errors' => $errors
    ];

    if ($this->request->getMethod() === 'post') {
        $rules = [
            'nom_compagnie' => 'required|min_length[8]',
            'code_compagnie' => 'required|min_length[6]'
        ];

        $messages = [
            'code_compagnie' => [
                'required' => 'Le code compagnie est requis et comporte au moins six lettres.'
            ],
            'nom_compagnie' => [
                'required' => 'Le nom est obligatoire.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            // Afficher les erreurs de validation
            $errors = $this->validator->getErrors();

            $data = [
                "status" => 401,
                "errors" => $errors
            ];

            return json_encode($data);
        }

        $compagnieModel->updateCompagnie($companyId,$compagnieData);
        // $compagnieModel->updateCompagnie($id, $compagnieData);

        $errors = "La mise à jour n'a pas été effectuée.";

        $data = [
            "status" => 200,
            "errors" => $errors,
            "redirect" => base_url("/admin/compagnie")
        ];

        return json_encode($data);
    }
}

 
    public function activer($id)
    {
        $compagnieModel= new CompagnieModel();
        $compagnieModel->activatedCompagnie($id);
        // Rediriger vers la page d'accueil ou la page de connexion
        $data=array(
            "status"=>200,
            "message"=>"Compagnie activer avec success"
        );
        return json_encode($data);
    }
    public function desactiver($id)
    {
        $compagnieModel= new CompagnieModel();
        $compagnieModel->desactivateCompagnier($id);
        // Rediriger vers la page d'accueil ou la page de connexion
        $data=array(
            "status"=>200,
            "message"=>"Compagnie desactiver avec success"
        );
        return json_encode($data);
    }





        // Méthode pour supprimer une compagnie
        public function delete($id = null)
        {
            
            $model = new CompagnieModel();
            $model->deleteCompagnie($id); // Supprime la compagnie
            $data=array(
                "status"=>200,
                "message"=>"Compagnie supprimer avec success"
            );
            return json_encode($data);
        }
    
}
