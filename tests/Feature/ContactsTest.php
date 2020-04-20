<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Contact;
use App\User;
use Carbon\Carbon;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     * makes sure only authenticated users can add a new contact entry.
     */
    public function an_authenticated_user_can_add_a_contact()
    {
        $this->post('/api/contacts', $this->data());

        $contact = Contact::first();

        $this->assertEquals('testname', $contact->name);
        $this->assertEquals('test@test.com', $contact->email);
        $this->assertEquals('11/06/1998', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC string', $contact->company);
    }

    /**
     * @test
     * makes sure all fields for are required.
     */
    public function fields_are_required()
    {
        collect('name', 'email', 'birthday', 'company')->each(function($field){
            $response = $this->post('/api/contacts',
                array_merge($this->data(), [$field=> '']));

            $response->assertSessionHasErrors($field);
            $this->assertCount(0, Contact::all());
        });
    }

    /**
     * @test
     */
    public function email_must_be_valid_email()
    {
        $response = $this->post('/api/contacts',
        array_merge($this->data(), ['email'=> 'not an email']));

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /**
     * @test
     */
    public function birthdays_are_properly_stored()
    {
        $response = $this->post('/api/contacts', $this->data());

        $this->assertCount(1, Contact::all());
        // $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('11/05/1998', Contact::first()->birthday);
    }

    /**
     * @test
     */
    public function a_contact_can_be_fetched()
    {
        $contact = factory(Contact::class)->create();

        $response = $this->get('api/contact/{$contact->id}?api_token={$this->user->api_token}');

        $response->assertJson([
            'name' => $contact->name,
            'email' => $contact->email,
            'birthday' => $contact->birthday,
            'company' => $contact->company
        ]);
    }

    /**
     * @test
     */
    public function a_contact_can_be_patched()
    {
        $contact = factory(Contact::class)->create();
        $response = $this->patch('/api/contacts/{$contact->id}', $this->data());

        $contact = $contact->fresh();

        $this->assertEquals('testname', $contact->name);
        $this->assertEquals('test@test.com', $contact->email);
        $this->assertEquals('11/06/1998', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('company', $contact->company);
    }

    /**
     * @test
     */
    public function a_contact_can_be_deleted()
    {
        $contact = factory(Contact::class)->create();
        $response = $this->delete('/api/contact/{contact->id}');

        $this->assertCount(0, Contact::all());
    }


    private function data()
    {
        return  [
            'name' => 'testname',
            'email' => 'test@test.com',
            'birthday' => '11/06/1998',
            'company' => 'ABC string',
            'api_token' => $this->user->api_token,
        ];
    }
}
