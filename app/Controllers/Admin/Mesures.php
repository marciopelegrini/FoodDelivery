<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Extra;
use App\Entities\Mesure;
use App\Models\MesureModel;

class Mesures extends BaseController
{

    private $mesureModel;

    public function __construct()
    {
        $this->mesureModel = new MesureModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des mesures des produits',
            'mesures' => $this->mesureModel->withDeleted(true)->paginate(10),
            'pager' => $this->mesureModel->pager,

        ];

        return view('Admin/Mesures/index', $data);
    }

    public function show($id = null)
    {
        $mesure = $this->chercheMesureOr404($id);

        $data = [
            'titre' => "Détails de la mesure: $mesure->nom",
            'mesure' => $mesure,
        ];
        return view('Admin/Mesures/show', $data);
    }

    public function editer($id = null)
    {
        $mesure = $this->chercheMesureOr404($id);

        if ($mesure->deleted_at != null) {
            return redirect()->back()->with('error', "La mesure $mesure->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
        }

        $data = [
            'titre' => "Éditer la mesure : $mesure->nom",
            'mesure' => $mesure,
        ];

        return view('Admin/Mesures/editer', $data);
    }

    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $mesure = $this->chercheMesureOr404($id);

            if ($mesure->deleted_at != null) {
                return redirect()->back()->with('error', "La mesure $mesure->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
            }

            $mesure->fill($this->request->getPost());

            if (!$mesure->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changer !');
            }

            if ($this->mesureModel->save($mesure)) {
                return redirect()->to(site_url("admin/mesures/show/$mesure->id"))
                    ->with('success', "La mesure $mesure->nom a bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->mesureModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function supprimer($id = null)
    {
        $mesure = $this->chercheMesureOr404($id);

        if ($mesure->deleted_at != null) {
            return redirect()->back()->with('error', "L'mesure $mesure->nom se trouve déjà supprimé !");
        }

        if ($this->request->getMethod() === 'post') {
            $this->mesureModel->delete($id);
            return redirect()->to(site_url('Admin/Mesures/'))->with('success', "La mesure $mesure->nom a bien été supprimé");
        }

        $data = [
            'titre' => "Supprimer mesure : $mesure->nom",
            'mesure' => $mesure,
        ];
        return view('Admin/Mesures/supprimer', $data);
    }

    public function creer()
    {
        $mesure = new Mesure();

        $data = [
            'titre' => "Créer une nouvelle mesure aux produits:",
            'mesure' => $mesure,
        ];
        return view('Admin/Mesures/creer', $data);
    }

    public function inserer()
    {
        if ($this->request->getMethod() === 'post') {

            $mesure = new Mesure($this->request->getPost());

            if ($this->mesureModel->save($mesure)) {
                return redirect()
                    ->to(site_url("admin/mesures/show/" . $this->mesureModel->getInsertID()))
                    ->with('success', "La mesure $mesure->nom a bien été enregistré !");
            } else {
                return redirect()
                    ->back()
                    ->with('errors_model', $this->mesureModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")
                    ->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function retablirMesure($id = null)
    {
        $mesure = $this->chercheMesureOr404($id);

        if ($mesure->deleted_at == null) {
            return redirect()->back()->with('info', 'Seulement mesures supprimés peuvent être récupérés !');
        }

        if ($this->mesureModel->retablir_mesure($id)) {
            return redirect()->back()->with('sucess', "La mesure a bien été rétabli !");
        } else {
            return redirect()
                ->back()
                ->with('errors_model', $this->mesureModel->errors())
                ->with('error', "Une erreur est arrivé !");
        }
    }

    public function rechercher()
    {
        if (!$this->request->isAJAX()) {
            exit('La page n\'existe pas !');
        }

        $mesures = $this->mesureModel->rechercher_mesures($this->request->getGet('term'));
        $return = [];

        foreach ($mesures as $mesure) {
            $data['id'] = $mesure->id;
            $data['value'] = $mesure->nom;

            $return[] = $data;
        }
        return $this->response->setJSON($return);
    }

    private function chercheMesureOr404(int $id = null)
    {
        if (!$id || !$mesure = $this->mesureModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Mesure'était pas trouvé");
        }
        return $mesure;
    }

}
