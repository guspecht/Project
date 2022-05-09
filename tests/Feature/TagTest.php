<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory;
use App\Models\User;

class TagTest extends TestCase
{
    /**
     *  Test store tag validation
     *
     * @return void
     */
    public function test_has_validation_on_store_tag(){
        $faker = Factory::create();
        $password = 'Pa$$W0rdGus';
        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail(),
            'password' => bcrypt($password),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->json('POST', 'admin/tags')
        ->assertStatus(422);
    }

    /**
     *  Test store a tag
     *
     * @return void
     */
    public function test_store_a_tag(){
        $faker = Factory::create();
        $password = 'Pa$$W0rdGus';

        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail(),
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $tagResponse = $this->post('admin/tags', [
            'name' => $faker->word,
        ]);

        $tagResponse->assertRedirect('admin/tags/');
    }
}
