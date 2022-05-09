<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory;
use App\Models\User;
use App\Models\Category;

class PostTest extends TestCase
{
    /**
     *  Test store post validation
     *
     * @return void
     */
    public function test_has_validation_on_store_post(){
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


        $this->json('POST', 'admin/posts')
        ->assertStatus(422);
    }

    /**
     *  Test store a post
     *
     * @return void
     */
    public function test_store_a_post(){
        $faker = Factory::create();
        $password = 'Pa$$W0rdGus';

        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail(),
            'password' => bcrypt($password),
        ]);

        $category = Category::create([
            'name' => $faker->word
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $postResponse = $this->post('admin/posts', [
            'title' => $faker->word,
            'text' => $faker->sentence,
            'image' => $faker->randomDigit .'_Untitled.png',
            'category' => $category->id,
            'tags' => "tag1, tag2, tag3"
        ]);

        $postResponse->assertRedirect('/');
    }
}
