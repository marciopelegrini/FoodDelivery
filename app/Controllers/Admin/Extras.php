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
