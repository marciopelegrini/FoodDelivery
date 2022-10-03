<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Produit;
use App\Models\CategorieModel;
use App\Models\ProduitModel;

class Produits extends BaseController
{
    private $produitModel;
    private $categorieModel;

    public function __construct()
    {
        $this->produitModel = new ProduitModel();
        $this->categorieModel = new CategorieModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des produits enregistrées.',
            'produits' => $this->produitModel
                ->select('produits.*, categories.nom AS categorie')
                ->join('categories', 'categories.id = produits.categorie_id')
                ->withDeleted(true)
                ->paginate(10),
            'pager' => $this->produitModel->pager,
        ];

        return view('Admin/Produits/index', $data);
    }

    public function show($id = null)
    {
        $produit = $this->chercheProduitOr404($id);

        $data = [
            'titre' => "Détails du produit : $produit->nom",
            'produit' => $produit,
        ];
        return view('Admin/Produits/show', $data);
    }

    public function editer($id = null)
    {
        $produit = $this->chercheProduitOr404($id);

        if ($produit->deleted_at != null) {
            return redirect()->back()->with('error', "Le produit $produit->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
        }

        $data = [
            'titre' => "Éditer produit : $produit->nom",
            'produit' => $produit,
            'categories' => $this->categorieModel->where('actif', true)->findAll(),
        ];

        return view('Admin/Produits/editer', $data);
    }

    public function editerImage($id = null)
    {
        $produit = $this->chercheProduitOr404($id);
        $data = [
            'titre' => "Éditer l'image du produit : $produit->nom",
            'produit' => $produit,
        ];

        return view('Admin/Produits/editer-image', $data);
    }

    public function upload($id = null)
    {
        $produit = $this->chercheProduitOr404($id);
        $photo = $this->request->getFile('photoproduit');

        if (!$photo->isValid()) {
            $code_erreur = $photo->getError();

            if ($code_erreur == UPLOAD_ERR_NO_FILE) {
                return redirect()->back()->with("error", 'Aucun fichier est séléctionné');
            }
        }

        $taille_image = $photo->getSizeByUnit('kb');
        if ($taille_image > "5000") {
            return redirect()->back()->with("error", "La taille du fichier ne doit pas dépasser 2Mo");
        }

        $type_image = $photo->getMimeType();
        $type_image_nettoye = explode('/', $type_image);
        $types_permis = ['jpeg', 'png', 'webp'];
        if (!in_array($type_image_nettoye[1], $types_permis)) {
            return redirect()->back()->with("error", "Ce fichier n'est pas permis.");
        }

        list($width, $height) = getimagesize($photo->getPathname());
        if ($width < "400" || $height < "400") {
            return redirect()->back()->with("error", "La photo doit être plus grande que 400x400 px");
        }

        $imageChemin = $photo->store('produits');

        dd($photo);
    }

    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $produit = $this->chercheProduitOr404($id);

            if ($produit->deleted_at != null) {
                return redirect()->back()->with('error', "Le produit $produit->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
            }

            $produit->fill($this->request->getPost());

            if (!$produit->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changer !');
            }

            if ($this->produitModel->save($produit)) {
                return redirect()->to(site_url("admin/produits/show/$produit->id"))
                    ->with('success', "Le produit $produit->nom a bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->produitModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function creer()
    {
        $produit = new Produit();

        $data = [
            'titre' => "Création d'un nouveau produit",
            'produit' => $produit,
            'categories' => $this->categorieModel->where('actif', true)->findAll(),
        ];

        return view('Admin/Produits/creer', $data);

    }

    public function inserer()
    {
        if ($this->request->getMethod() === 'post') {

            $produits = new Produit($this->request->getPost());

            if ($this->produitModel->save($produits)) {
                return redirect()
                    ->to(site_url("admin/produits/show/" . $this->produitModel->getInsertID()))
                    ->with('success', "Le produit $produits->nom a bien été enregistré !");
            } else {
                return redirect()
                    ->back()
                    ->with('errors_model', $this->produitModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")
                    ->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function recherche_produit()
    {
        if (!$this->request->isAJAX()) {
            exit('La page n\'existe pas !');
        }

        $produits = $this->produitModel->recherche_produit($this->request->getGet('term'));
        $return = [];

        foreach ($produits as $produit) {
            $data['id'] = $produit->id;
            $data['value'] = $produit->nom;

            $return[] = $data;
        }
        return $this->response->setJSON($return);
    }

    private function chercheProduitOr404(int $id = null)
    {
        if (!$id || !$produit = $this->produitModel->select('produits.*, categories.nom AS categorie')
                ->join('categories', 'categories.id = produits.categorie_id')
                ->withDeleted(true)
                ->where('produits.id', $id)
                ->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produit n'était pas trouvé");
        }
        return $produit;
    }

}
