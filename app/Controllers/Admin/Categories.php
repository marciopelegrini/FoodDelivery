<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Categorie;
use App\Models\CategorieModel;

class Categories extends BaseController
{
    private $categorieModel;

    public function __construct()
    {
        $this->categorieModel = new CategorieModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des categories',
            'categories' => $this->categorieModel->withDeleted(true)->paginate(5),
            'pager' => $this->categorieModel->pager,
        ];

        return view('Admin/Categories/index', $data);
    }

    public function recherche_categorie()
    {
        if (!$this->request->isAJAX()) {
            exit('Page pas trouvé!');
        }

        $categories = $this->categorieModel->recherche_categories($this->request->getGet('term'));
        $return = [];

        foreach ($categories as $categorie) {
            $data['id'] = $categorie->id;
            $data['value'] = $categorie->nom;

            $return[] = $data;
        }
        return $this->response->setJSON($return);
    }

    /*
    *
    */
    public function show($id = null)
    {
        $categorie = $this->chercheCategorieOr404($id);

        $data = [
            'titre' => "Détails de la categorie: $categorie->nom",
            'categorie' => $categorie,
        ];
        return view('Admin/Categories/show', $data);
    }

    public function creer()
    {
        $categorie = new Categorie();


        $data = [
            'titre' => "Créer une nouvelle categorie:",
            'categorie' => $categorie,
        ];
        return view('Admin/Categories/creer', $data);
    }

    public function inserer()
    {
        if ($this->request->getMethod() === 'post') {

            $categorie = new Categorie($this->request->getPost());

            if ($this->categorieModel->save($categorie)) {
                return redirect()
                    ->to(site_url("admin/categories/show/" . $this->categorieModel->getInsertID()))
                    ->with('success', "La categorie $categorie->nom a bien été enregistré !");
            } else {
                return redirect()
                    ->back()
                    ->with('errors_model', $this->categorieModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")
                    ->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function supprimer($id = null)
    {
        $categorie = $this->cherchecategorieOr404($id);

        if ($categorie->deleted_at != null) {
            return redirect()->back()->with('error', "La categorie $categorie->nom se trouve déjà supprimé !");
        }

        if ($this->request->getMethod() === 'post') {
            $this->categorieModel->delete($id);
            return redirect()->to(site_url('Admin/Categories/'))->with('success', "La categorie $categorie->nom a bien été supprimé");
        }

        $data = [
            'titre' => "Supprimer categorie : $categorie->nom",
            'categorie' => $categorie,
        ];
        return view('Admin/Categories/supprimer', $data);
    }

    public function retablirCategorie($id = null)
    {
        $categorie = $this->chercheCategorieOr404($id);

        if ($categorie->deleted_at == null) {
            return redirect()->back()->with('info', 'Seulement categories supprimés peuvent être récupérés !');
        }

        if ($this->categorieModel->retablirCategorie($id)) {
            return redirect()->back()->with('sucess', "La categorie a bien été rétabli !");
        } else {
            return redirect()
                ->back()
                ->with('errors_model', $this->categorieModel->errors())
                ->with('error', "Une erreur est arrivé !");
        }
    }

    public function editer($id = null)
    {
        $categorie = $this->chercheCategorieOr404($id);

        if ($categorie->deleted_at != null) {
            return redirect()->back()->with('error', "L'categorie $categorie->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
        }

        $data = [
            'titre' => "Éditer l'categorie : $categorie->nom",
            'categorie' => $categorie,
        ];

        return view('Admin/Categories/editer', $data);
    }

    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $categorie = $this->cherchecategorieOr404($id);

            if ($categorie->deleted_at != null) {
                return redirect()->back()->with('error', "L'categorie $categorie->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
            }

            $categorie->fill($this->request->getPost());

            if (!$categorie->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changer !');
            }

            if ($this->categorieModel->save($categorie)) {
                return redirect()->to(site_url("admin/categories/show/$categorie->id"))
                    ->with('success', "La categorie $categorie->nom a bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->categorieModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    /*
    *
    */
    private function chercheCategorieOr404(int $id = null)
    {
        if (!$id || !$categorie = $this->categorieModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Catégorie n'était pas trouvé");
        }
        return $categorie;
    }
}
