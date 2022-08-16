<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function testRegisterRenderPage()
    {
        $this->get('register')->assertStatus(200);
    }

    public function testLoginRenderPage()
    {
        $this->get('register')->assertStatus(200);
    }

    public function testRegister()
    {
        $user = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $response = $this->post('register',$user);
        $this->assertAuthenticated();
        $response->assertRedirect('/home'); 
    }

    public function testLogin()
    {
        $user = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $response = $this->post('register',$user);
        $response = $this->post('login',[
            'email' => 'test@gmail.com',
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/home'); 
    }
}
