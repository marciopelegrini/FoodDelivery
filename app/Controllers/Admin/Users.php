<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\User;
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
            'users' => $this->usagerModel->withDeleted(true)->paginate(5),
            'pager'=> $this->usagerModel->pager
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
    public function supprimer($id = null)
    {
        $usager = $this->chercheUsagerOr404($id);

        if ($usager->deleted_at != null) {
            return redirect()->back()->with('error', "L'usager $usager->nom se trouve déjà supprimé !");
        }

        if ($usager->is_admin) {
            return redirect()->back()->with('error', "Veuillez notez qu'il n'est pas possible de supprimer un usager <b>Administrateur</b>");
        }

        if ($this->request->getMethod() === 'post') {
            $this->usagerModel->delete($id);
            return redirect()->to(site_url('Admin/Users/'))->with('success', "Usager $usager->nom a bien été supprimé");
        }

        $data = [
            'titre' => "Supprimer l'usager : $usager->nom",
            'usager' => $usager,
        ];
        return view('Admin/Users/supprimer', $data);
    }

    /*
     *
     */
    public function creer()
    {
        $usager = new User();
        $data = [
            'titre' => "Création d'un nouveau usager",
            'usager' => $usager,
        ];
        return view('Admin/Users/creer', $data);
    }

    /*
     *
     */
    public function inserer()
    {
        if ($this->request->getMethod() === 'post') {

            $usager = new User($this->request->getPost());

            if ($this->usagerModel->protect(false)->save($usager)) {
                return redirect()->to(site_url("admin/users/show/" . $this->usagerModel->getInsertID()))
                    ->with('success', "L'usager $usager->nom a bien été enregistré !");
            } else {
                return redirect()->back()->with('errors_model', $this->usagerModel->errors())
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
    public function editer($id = null)
    {
        $usager = $this->chercheUsagerOr404($id);

        if ($usager->deleted_at != null) {
            return redirect()->back()->with('error', "L'usager $usager->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
        }

        $data = [
            'titre' => "Éditer l'usager : $usager->nom",
            'usager' => $usager,
        ];

        return view('Admin/Users/editer', $data);
    }

    /*
  *
  */
    public function retablirusager($id = null)
    {
        $usager = $this->chercheUsagerOr404($id);

        if ($usager->deleted_at == null) {
            return redirect()->back()->with('info', 'Seulement usagers supprimés peuvent être récupérés !');
        }

        if ($this->usagerModel->retablirusager($id)) {
            return redirect()->back()->with('sucess', "L'usager a bien été rétabli !");
        } else {
            return redirect()
                ->back()
                ->with('errors_model', $this->usagerModel->errors())
                ->with('error', "Une erreur est arrivé !");
        }

        $data = [
            'titre' => "Éditer l'usager : $usager->nom",
            'usager' => $usager,
        ];

        return view('Admin/Users/editer', $data);
    }

    /*
     *
     */
    public function enregistrer($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $usager = $this->chercheUsagerOr404($id);

            if ($usager->deleted_at != null) {
                return redirect()->back()->with('error', "L'usager $usager->nom se trouve supprimé, donc il n'est pas possible de l'éditer !");
            }

            $post = $this->request->getPost();

            if (empty($post['mot_de_passe'])) {
                $this->usagerModel->pasDeValidationMotDePasse();
                unset($post['mot_de_passe']);
                unset($post['confirm_mot_de_passe']);
            }

            $usager->fill($post);

            if (!$usager->hasChanged()) {
                return redirect()->back()->with('info', 'Il n\'y a pas de données à changer !');
            }

            if ($this->usagerModel->protect(false)->save($usager)) {
                return redirect()->to(site_url("admin/users/show/$usager->id"))
                    ->with('success', "Usager $usager->nom bien été changé !");
            } else {
                return redirect()->back()->with('errors_model', $this->usagerModel->errors())
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
    private function chercheUsagerOr404(int $id = null)
    {
        if (!$id || !$usager = $this->usagerModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usager n'était pas trouvé");
        }
        return $usager;
    }
}
