<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_displays_the_login_form()
    {
        $response = $this->get(route('user.login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_login_displays_validation_errors(): void
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('username');
        $response->assertSessionHasErrors('password');
    }

    public function test_login_authenticates_and_redirects_user(): void
    {
        $user = User::firstWhere('username', 'ashish');

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'TestP@ssword#1234'
        ]);

        $response->assertRedirect(route('worklogs.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_authenticates_and_redirects_admin(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'TestP@ssword#1234'
        ]);

        $response->assertRedirect(route('admin.worklogs.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_route_redirects_to_dashboard_for_authenticated_user(): void
    {
        $user = User::firstWhere('username', 'ashish');
        $this->post('/login', [
            'username' => $user->username,
            'password' => 'TestP@ssword#1234'
        ]);

        $response = $this->get(route('user.login'));

        $response->assertRedirect(route('worklogs.index'));
    }
}
