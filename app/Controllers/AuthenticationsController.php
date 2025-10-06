<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthenticationsController extends Controller
{
    protected string $layout = 'login';

    public function new(): void
    {
        $this->render('authentications/new');
    }

    public function authenticate(Request $request): void
    {
        $params = $request->getParam('user');
        $user = User::findByEmail($params['email']);

        if ($user && $user->authenticate($params['password'])) {
            Auth::login($user);

            $_SESSION['user']['id'] = $user->getId();

            FlashMessage::success('Login realizado com sucesso!');

            $this->redirectTo(route('receitas.phtml'));
        } else {
            FlashMessage::danger('E-mail ou senha inválidos.');
            $this->redirectTo(route('index.phtml'));
        }
    }

    public function destroy(): void
    {
        Auth::logout();

        unset($_SESSION['user']['id']);

        FlashMessage::success('Logout realizado com sucesso!');
        $this->redirectTo(route('users.login'));
    }
}
