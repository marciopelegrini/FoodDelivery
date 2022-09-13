<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Extra;
use App\Models\ExtraModel;

class Extras extends BaseController
{
    private $extraModel;

    public function __construct()
    {
        $this->extraModel = new ExtraModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des extras des produits',
            'extras' => $this->extraModel->withDeleted(true)->paginate(10),
            'pager' => $this->extraModel->pager,
        ];
        return view('Admin/Extras/index', $data);
    }

    public function show($id = null)
    {
        $extra = $this->chercheExtraOr404($id);

        $data = [
            'titre' => "Détails de l'extra: $extra->nom",
            'extra' => $extra,
        ];
        return view('Admin/Extras/show', $data);
    }

    public function editer($id = null)
    {
        $extra = $this->chercheExtraOr404($id);

        if ($extra->deleted_at != null) {
            return redirect()->back()->with('error', "L'extra $extra->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
        }

        $data = [
            'titre' => "Éditer l'extra : $extra->nom",
            'extra' => $extra,
        ];

        return view('Admin/Extras/editer', $data);
    }

    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $extra = $this->chercheExtraOr404($id);

            if ($extra->deleted_at != null) {
                return redirect()->back()->with('error', "L'extra $extra->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
            }

            $extra->fill($this->request->getPost());

            if (!$extra->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changer !');
            }

            if ($this->extraModel->save($extra)) {
                return redirect()->to(site_url("admin/extras/show/$extra->id"))
                    ->with('success', "L'extra $extra->nom a bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->extraModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    public function creer()
    {
        $extra = new Extra();

        $data = [
            'titre' => "Créer un nouveau extra aux produits:",
            'extra' => $extra,
        ];
        return view('Admin/Extras/creer', $data);
    }

    public function inserer()
    {
        if ($this->request->getMethod() === 'post') {

            $extra = new Extra($this->request->getPost());

            if ($this->extraModel->save($extra)) {
                return redirect()
                    ->to(site_url("admin/extras/show/" . $this->extraModel->getInsertID()))
                    ->with('success', "L'extra $extra->nom a bien été enregistré !");
            } else {
                return redirect()
                    ->back()
                    ->with('errors_model', $this->extraModel->errors())
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
        $extra = $this->chercheExtraOr404($id);

        if ($extra->deleted_at != null) {
            return redirect()->back()->with('error', "L'extra $extra->nom se trouve déjà supprimé !");
        }

        if ($this->request->getMethod() === 'post') {
            $this->extraModel->delete($id);
            return redirect()->to(site_url('Admin/Extras/'))->with('success', "L'extra $extra->nom a bien été supprimé");
        }

        $data = [
            'titre' => "Supprimer extra : $extra->nom",
            'extra' => $extra,
        ];
        return view('Admin/Extras/supprimer', $data);
    }

    public function retablirExtra($id = null)
    {
        $extra = $this->chercheExtraOr404($id);

        if ($extra->deleted_at == null) {
            return redirect()->back()->with('info', 'Seulement extras supprimés peuvent être récupérés !');
        }

        if ($this->extraModel->retablir_extra($id)) {
            return redirect()->back()->with('sucess', "L'extra a bien été rétabli !");
        } else {
            return redirect()
                ->back()
                ->with('errors_model', $this->extraModel->errors())
                ->with('error', "Une erreur est arrivé !");
        }
    }


    public function rechercher()
    {
        if (!$this->request->isAJAX()) {
            exit('La page n\'existe pas !');
        }

        $extras = $this->extraModel->rechercher_extras($this->request->getGet('term'));
        $return = [];

        foreach ($extras as $extra) {
            $data['id'] = $extra->id;
            $data['value'] = $extra->nom;

            $return[] = $data;
        }
        return $this->response->setJSON($return);
    }

    private function chercheExtraOr404(int $id = null)
    {
        if (!$id || !$extra = $this->extraModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Extra n'était pas trouvé");
        }
        return $extra;
    }

}
