<?php

namespace App\Http\Controllers\Auth;

use App\Models\Department;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('auth.register', ['departments' => Department::all()]);
    }

    /**
     * Register a new user
     *
     * @param RegisterUserRequest $request
     * @return Factory|View|RedirectResponse
     */
    public function store(RegisterUserRequest $request)
    {
        $userData = $request->safe()->except('confirmPassword');

        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);

        return redirect()
            ->route('user.login')
            ->with('userRegistrationStatus', 'User registration successful. Login to continue.');
    }
}
