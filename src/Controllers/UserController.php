<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Profile;

class UserController
{
    public function index()
    {
        $users = User::findAll();
        require __DIR__ . '/../Views/user/index.php';
    }

    public function create()
    {
        $profiles = Profile::findAll();
        require __DIR__ . '/../Views/user/create.php';
    }

    public function store()
    {
        $user = new User();
        $user->nome = $_POST['nome'];
        $user->login = $_POST['login'];
        if (!empty($_POST['senha'])) {
            $user->senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        }
        $user->ativo = isset($_POST['ativo']) ? 1 : 0;

        $profileIds = $_POST['profiles'] ?? [];
        $user->save($profileIds);

        header('Location: /sysfin-4dsn/users');
    }

    public function edit($id)
    {
        $user = User::findById($id);
        $allProfiles = Profile::findAll();
        require __DIR__ . '/../Views/user/edit.php';
    }

    public function update($id)
    {
        $user = User::findById($id);
        $user->nome = $_POST['nome'];
        $user->login = $_POST['login'];
        if (!empty($_POST['senha'])) {
            $user->senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        }
        $user->ativo = isset($_POST['ativo']) ? 1 : 0;

        $profileIds = $_POST['profiles'] ?? [];
        $user->save($profileIds);

        header('Location: /sysfin-4dsn/users');
    }

    public function delete($id)
    {
        $user = User::findById($id);
        if ($user) {
            $user->delete();
        }
        header('Location: /sysfin-4dsn/users');
    }
}
