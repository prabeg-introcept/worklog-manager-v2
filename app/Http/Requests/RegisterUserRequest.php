<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:App\Models\User,email|max:255',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirmPassword' => 'required|string|same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Please enter your username',
            'username.max' => 'Please enter less than 255 characters',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'Please enter a different email. User with this email already exists',
            'email.max' => 'Please enter less than 255 characters',
            'password.required' => 'Please enter a password',
            'password.regex' => 'Password must be 8 characters long and consists of at least one lower case, one upper case letter, at least one number and a special character',
            'confirmPassword.required' => 'Please re-enter password for confirmation',
            'confirmPassword.same' => 'Passwords do not match'
        ];
    }
}
