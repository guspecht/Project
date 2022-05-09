<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory;
use App\Models\User;

class CategoryTest extends TestCase
{
    /**
     *  Test store category validation
     *
     * @return void
     */
    public function test_has_validation_on_store_category(){
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

        $this->json('POST', 'admin/categories')
        ->assertStatus(422);
    }

    /**
     *  Test store a category
     *
     * @return void
     */
    public function test_store_a_category(){
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

        $CategoryResponse = $this->post('admin/categories', [
            'name' => $faker->word,
        ]);

        $CategoryResponse->assertRedirect('admin/categories/');
    }
}
