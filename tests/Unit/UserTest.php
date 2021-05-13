<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class UserTest extends TestCase
{


    public function testUserAuthentication(){
        $response = $this->post('api/login',['email'=>'filipp-tts@outlook.com', 'password'=>'12345678']);
        $this->assertEquals(201,$response->status());
    }

    public function testLoginValidation(){
        $response = $this->post('api/login',['email'=>'', 'password'=>'']);
        $this->assertEquals(302,$response->status());
    }

    public function testLoginIsAdmin(){
        $response = $this->post('api/login',['email'=>'filipp-tts@outlook.com', 'password'=>'12345678']);
        $this->assertEquals(1,$response['isAdmin']);
    }
    public function testLoginIsNotAdmin(){
        $response = $this->post('api/login',['email'=>'nico@outlok.com', 'password'=>'12345678']);
        $this->assertEquals(0,$response['isAdmin']);
    }

    public function test_console_command()
    {
        $this->artisan('sendLogMailToAdmin')
            ->assertExitCode(0);
    }

}
