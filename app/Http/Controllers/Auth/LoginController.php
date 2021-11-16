<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * @param LoginUserRequest $request
     * @return RedirectResponse
     */
    public function store(LoginUserRequest $request)
    {
        if(!Auth::attempt($request->validated()))
        {
            return back()
                ->with(['userLoginStatus' => 'Invalid credentials! Please try again.']);
        }
        $request->session()->regenerate();

        return redirect()->route('worklogs.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
