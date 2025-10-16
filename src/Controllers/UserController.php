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
        $user->senha = $_POST['senha'];
        $user->ativo = isset($_POST['ativo']);

        if (isset($_POST['profiles'])) {
            $user->setProfiles($_POST['profiles']);
        }

        $user->save();
        header('Location: /users');
    }

    public function edit($params)
    {
        $id = $params[0];
        $user = User::findById($id);
        $profiles = Profile::findAll();
        require __DIR__ . '/../Views/user/edit.php';
    }

    public function update($params)
    {
        $id = $params[0];
        $user = User::findById($id);
        if ($user) {
            $user->nome = $_POST['nome'];
            $user->login = $_POST['login'];
            if (!empty($_POST['senha'])) {
                $user->senha = $_POST['senha'];
            }
            $user->ativo = isset($_POST['ativo']);

            $profileIds = $_POST['profiles'] ?? [];
            $user->setProfiles($profileIds);

            $user->save();
        }
        header('Location: /users');
    }

    public function delete($params)
    {
        $id = $params[0];
        $user = User::findById($id);
        if ($user) {
            $user->delete();
        }
        header('Location: /users');
    }
}
