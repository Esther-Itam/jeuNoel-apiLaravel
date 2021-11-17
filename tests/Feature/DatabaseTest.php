<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DatabaseTest extends TestCase
{

    use RefreshDatabase;
    
    public function testValidRegistration()
    {
        
        $count = User::count();
 
        $response=$this->post('/api/register', [
            'name' => 'test',
            'email' => 'toto@gmail.com',
            'password' => 'password',
             'confirm_password' => 'password'
        ]);
 
        $newCount =User::count();
        $this->assertNotEquals($count, $newCount);
    }
}
