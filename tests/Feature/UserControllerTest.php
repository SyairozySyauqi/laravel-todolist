<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user'=> 'MSS',
        ])->get('login')->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'MSS',
            'password' => 'test',
        ])->assertRedirect('/')->assertSessionHas('user', 'MSS');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            'user'=> 'MSS',
        ])->post('login', [
            'user'=> 'MSS',
            'password'=> 'test',
        ])->assertRedirect('/')->assertSessionHas('user', 'MSS');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])->assertSeeText('User or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user'=> 'login',
            'password'=> 'password',
        ])->assertSeeText('User or password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            'user'=> 'MSS',
        ])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }
}
