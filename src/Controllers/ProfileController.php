<?php

namespace App\Controllers;

use App\Models\Profile;

class ProfileController
{
    public function index()
    {
        $profiles = Profile::getAll();
        require '../src/Views/profile/index.php';
    }

    public function create()
    {
        require '../src/Views/profile/create.php';
    }

    public function store()
    {
        Profile::create($_POST);
        header('Location: /profiles');
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        require '../src/Views/profile/edit.php';
    }

    public function update($id)
    {
        Profile::update($id, $_POST);
        header('Location: /profiles');
    }

    public function delete($id)
    {
        Profile::delete($id);
        header('Location: /profiles');
    }
}

