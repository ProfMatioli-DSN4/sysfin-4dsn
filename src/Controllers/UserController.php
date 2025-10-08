<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Profile;

class UserController
{
    public function index()
    {
        $users = User::getAll();
        require '../src/Views/user/index.php';
    }

    public function create()
    {
        $profiles = Profile::getAll();
        require '../src/Views/user/create.php';
    }

    public function store()
    {
        User::create($_POST);
        header('Location: /users');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $profiles = Profile::getAll();
        require '../src/Views/user/edit.php';
    }

    public function update($id)
    {
        User::update($id, $_POST);
        header('Location: /users');
    }

    public function delete($id)
    {
        User::delete($id);
        header('Location: /users');
    }
}

