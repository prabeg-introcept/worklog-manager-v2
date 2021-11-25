<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_register_displays_registration_form(): void
    {
        $response = $this->get(route('user.register'));

        $response->assertViewIs('auth.register');
    }

    public function test_register_displays_validation_error(): void
    {
        $response = $this->post('/register', array());

        $response->assertSessionHasErrors(['username', 'email', 'password']);
    }

    public function test_register_new_user_and_redirect_to_login(): void
    {
        $user = array(
            'username' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'department_id' => rand(1, 6),
            'password' => $this->faker->password(12)
        );
        $user['password_confirmation'] = $user['password'];

        $response = $this->post('/register',$user);

        $this->assertDatabaseHas('users', [
            'username' => $user['username'],
            'email' => $user['email'],
            'department_id' => $user['department_id']
        ]);
        $response->assertRedirect(route('user.login'));
    }
}
