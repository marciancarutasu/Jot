<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**test */
    public function test()
    {
        $this->assertEquals(1,1);
    }
    /**
     * @test
     * if user is not logged in, cannot perform any action and will be redirected to login page.
    */
    // public function a_unauthenticated_user_should_be_redirected_to_login()
    // {
    //     $response = $this->post('/api/contacts', $this->data());//test
    //     $response->assertRedirect('login');

    //     $this->assertCount(0, Contact::all());
    // }

    // //test
    // private function data()
    // {
    //     return  [
    //         'name' => 'testname',
    //         'email' => 'test@test.com',
    //         'birthday' => '11/06/1998',
    //         'company' => 'ABC string'
    //     ];
    // }
}