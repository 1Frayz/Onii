<?php

namespace App\Controllers;

use App\Application\Alerts\Alert;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\User\UserService;

class UserController
{
    private UserService $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function register(Request $request): void
    {
        $request->validation([
            "email" => ["required", "email"],
            "username" => ["required"],
            "password" => ["required", "password_confirm"],
        ]);
        if ($request->validationStatus()) {
            Alert::storeMessage('Check the fields are correct', Alert::DANGER);
            Redirect::to("/register");
        }

        $this->service->register([
            "email" => $request->post("email"),
            "username" => $request->post("username"),
            "password" => $request->post("password"),
            "password_confirm" => $request->post("password_confirm"),
        ]);
        Alert::storeMessage('Registration completed successfully. Sign in to your account.', Alert::SUCCESS);
        Redirect::to("/login");
    }

    public function login(Request $request): void
    {
        $request->validation([
            "username" => ["required"],
            "password" => ["required"],
        ]);

        if ($request->validationStatus()) {
            Alert::storeMessage('Incorrect username or password', Alert::DANGER);
            Redirect::to("/login");
        }
        $auth = $this->service->login(
            $request->post("username"),
            $request->post("password"),
        );
        if (!$auth) {
            Redirect::to("/login");
        } else {
            Redirect::to("/");
        }
    }

    public function logout(): void
    {
        $this->service->logout();
        Redirect::to('/');
    }
}
