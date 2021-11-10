<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Str;


class ModelTest extends TestCase
{
  public function testValidRegistration()
   {
       $faker=Factory::create();
       $email = $faker->unique()->email;
       $count = User::count();

       $response=$this->post('/api/register', [
           'name' => 'test',
           'email' => $email,
           'password' => 'password',
            'confirm_password' => 'password'
       ]);

       $newCount =User::count();
       $this->assertNotEquals($count, $newCount);
   }
  public function testInvalidRegistration()
   {
       $response = $this->post('/api/register', [
        'name' => 'test',
        'email' => '',
        'password' => 'password',
        'confirm_password' => 'password'
    ]);
  
    $response->assertJsonValidationErrors('email');
   } 
}
