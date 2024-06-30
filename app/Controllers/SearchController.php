<?php

namespace App\Controllers;

use App\Application\Request\Request;
use App\Application\Router\Redirect;

class SearchController
{

    public function search(Request $request)
    {
        Redirect::to("/search/" . $request->post("query"));
    }
}
