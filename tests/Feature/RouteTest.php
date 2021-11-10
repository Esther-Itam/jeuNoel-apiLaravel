<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class RouteTest extends TestCase
{

 public function testAccessAdminWithGuestRole()
    {
        $response=$this->get('./teamBuilding');
        $response->assertRedirect('/');
    } 

   public function testAcessAdminWithIS_ADMIN()
    {
        $admin = Auth::loginUsingId(92);
        $this->actingAs($admin);
        $response=$this->get('/quiz/10');
        $response->assertStatus(200);
    } 
}
