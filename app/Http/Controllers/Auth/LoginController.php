<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LoginController extends Controller
{
    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('auth.login');
    }
}
