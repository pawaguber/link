<?php

namespace App\Http\Controllers;

use App\Services\MainService;

class BaseController extends Controller
{
    public $service;

    public function __construct(MainService $service)
    {
        $this->service = $service;
    }
}
