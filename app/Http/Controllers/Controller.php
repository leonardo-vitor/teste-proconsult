<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
}
