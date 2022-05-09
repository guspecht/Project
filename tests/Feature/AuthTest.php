<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     *  Test login validation
     *
     * @return void
     */
    public function test_validation_on_login()
    {
        $response = $this->json('POST', 'login')
            ->assertStatus(422);
    }

    /**
     *  Must display error messages missing, email and password.
     *
     * @return void
     */
    public function test_login_displays_validation_errors()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }

    /**
     *  Test if user can be created
     *  Test if admin get authenticated after login in
     *  Test if admin is redirected to dashboard
     * @return void
     */
    public function test_login_success()
    {
        $faker = Factory::create();
        $password = 'Pa$$W0rdGus';

        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail(),
            'password' => bcrypt($password),
        ]);

        $this->assertNotNull($user);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
