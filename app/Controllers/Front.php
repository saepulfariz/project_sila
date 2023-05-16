<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Front extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome'
        ];

        return view('front/index', $data);
    }
}
