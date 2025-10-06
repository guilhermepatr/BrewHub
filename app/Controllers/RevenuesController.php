<?php

namespace App\Controllers;

use App\Models\Revenues;
use Core\Http\Controllers\Controller;
use App\Models\User;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class RevenuesController extends Controller
{
    private ?User $currentUser = null;



    public function currentUser(): ?User
    {
        if ($this->currentUser === null && isset($_SESSION['user']['id'])) {
            $this->currentUser = User::findById($_SESSION['user']['id']);
        }

        return $this->currentUser;
    }

    public function authenticated(): bool
    {
        if ($this->currentUser() === null) {
            FlashMessage::danger('Você precisa estar logado para acessar essa página.');

            $this->redirectTo(route('users.login'));
            return false;
        }
        return true;
    }



    public function index(Request $request): void
    {

        if ($this->authenticated() === null) {
            FlashMessage::danger('Você precisa estar logado para acessar essa página.');

            $this->redirectTo(route('users.login'));
        }

        if(!$this->authenticated()) {
            return;

        }

        $paginator = Revenues::paginate(page: $request->getParam('page', 1));
        $page = (int) $request->getParam('page', 1);
        $paginator = Revenues::paginate(page: $page);
        $revenues = $paginator->registers();

        $title = 'Lista de Receitas';
    }
}
