<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorklogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $user = User::firstWhere('username', 'ashish');
        $this->post('/login', [
            'username' => $user->username,
            'password' => 'TestP@ssword#1234'
        ]);
    }

    public function test_add_worklog_displays_add_worklog_form(): void
    {
        $response = $this->get(route('worklogs.create'));

        $response->assertViewIs('user.worklog.create');
    }

    public function test_add_worklog_form_dsiplays_validation_error(): void
    {
        $response = $this->post(route('worklogs.store'), []);

        $response->assertSessionHasErrors('title');
    }
}
