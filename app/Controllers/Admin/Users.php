<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use function PHPUnit\Framework\throwException;

class Users extends BaseController
{

    private $usagerModel;

    public function __construct()
    {
        $this->usagerModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des usagers',
            'users' => $this->usagerModel->findAll(),
        ];

        return view('Admin/Users/index', $data);

    }

    /*
     * @Usage: recherche un usager à partir du composante autocomplete dans la view
     * @param string
     * @return array
     */
    public function recherche_usager()
    {
        if (!$this->request->isAJAX()) {
            exit('Page pas trouvé!');
        }

        $users = $this->usagerModel->recherche_usager($this->request->getGet('term'));

        $return = [];

        foreach ($users as $user) {
            $data['id'] = $user->id;
            $data['value'] = $user->nom;

            $return[] = $data;
        }

        return $this->response->setJSON($return);
    }

    /*
     *
     */
    public function show($id = null)
    {
        $usager = $this->chercheUsagerOr404($id);

        $data = [
            'titre' => "Détails d'usager : $usager->nom",
            'usager' => $usager,
        ];

        return view('Admin/Users/show', $data);
    }

    /*
     *
     */
    public function editer($id = null)
    {
        $usager = $this->chercheUsagerOr404($id);

        $data = [
            'titre' => "Éditer l'usager : $usager->nom",
            'usager' => $usager,
        ];

        return view('Admin/Users/editer', $data);
    }

    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $usager = $this->chercheUsagerOr404($id);

            $post = $this->request->getPost();

            if (empty($post['mot_de_passe'])) {
                $this->usagerModel->pasDeValidationMotDePasse();
                unset($post['mot_de_passe']);
                unset($post['confirm_mot_de_passe']);
            }

            $usager->fill($post);

            if (!$usager->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changé !');
            }

            if ($this->usagerModel->protect(false)->save($usager)) {
                return redirect()->to(site_url("admin/users/show/$usager->id"))
                    ->with('success', "Usager $usager->id a bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->usagerModel->errors())
                    ->with('atention', "Veuillez corrigez les erreus !")->withInput();
            }

        } else {
            /* N'est pas post */
            return redirect()->back();
        }
    }

    private function chercheUsagerOr404(int $id = null)
    {
        if (!$id || !$usager = $this->usagerModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usager n'était pas trouvé");
        }
        return $usager;
    }
}
