<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register a new user
     *
     * @param RegisterUserRequest $request
     * @return Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id
        ]);

        return redirect()
            ->route('user.login')
            ->with('userRegistrationStatus', 'User registration successful. Login to continue.');
    }
}
