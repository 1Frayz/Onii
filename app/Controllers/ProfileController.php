<?php

namespace App\Controllers;

use App\Application\Auth\Auth;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Profile\ProfileService;

class ProfileController
{
    private ProfileService $service;
    public function __construct()
    {
        $this->service = new ProfileService();
    }

    public function update(Request $request)
    {
        if ($request->file("image")["name"] != "") {
            $this->service->updateAvatar($request->file("image"));
        }
        $this->service->update($request->post("name"), $request->post("bio"), $request->post("links"));
        Redirect::toProfile(Auth::username());
    }
}
