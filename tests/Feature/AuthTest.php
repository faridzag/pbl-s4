<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_validation()
    {
        // Test empty fields
        $response = $this->post('/login', []);
        $response->assertSessionHasErrors(['login', 'password']);

        // Test with only email
        $response = $this->post('/login', ['login' => 'test@gmail.com']);
        $response->assertSessionHasErrors(['password']);
    }

    public function test_login_type_branches()
    {
        // Test email branch
        $response = $this->post('/login', [
            'login' => 'jpcuser@mail.me',
            'password' => '123456'
        ]);
        $response->assertSessionHasErrors();
        //$response->assertRedirect('home');

        // Test username branch
        $response = $this->post('/login', [
            'login' => 'jpcuser',
            'password' => '12345'
        ]);
        $response->assertSessionHasErrors();
    }
}
