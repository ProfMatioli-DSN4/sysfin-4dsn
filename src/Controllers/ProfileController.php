<?php

namespace App\Controllers;

use App\Models\Profile;

class ProfileController
{
    public function index()
    {
        $profiles = Profile::findAll();
        require __DIR__ . '/../Views/profile/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../Views/profile/create.php';
    }

    public function store()
    {
        $profile = new Profile();
        $profile->nome = $_POST['nome'];
        $profile->save();
        header('Location: /profiles');
    }

    public function edit($params)
    {
        $id = $params[0];
        $profile = Profile::findById($id);
        require __DIR__ . '/../Views/profile/edit.php';
    }

    public function update($params)
    {
        $id = $params[0];
        $profile = Profile::findById($id);
        if ($profile) {
            $profile->nome = $_POST['nome'];
            $profile->save();
        }
        header('Location: /profiles');
    }

    public function delete($params)
    {
        $id = $params[0];
        $profile = Profile::findById($id);
        if ($profile) {
            $profile->delete();
        }
        header('Location: /profiles');
    }
}
