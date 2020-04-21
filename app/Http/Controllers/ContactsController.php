<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{

    /**
     * Gets current app user from request object and retrieves all associated contacts.
     */
    public function index()
    {
        return $request()->user()->contacts;
    }
    /**
     * POST method for contacts CRUD.
     */
    public function store()
    {
       Contact::create($this->validateData());
    }

    /**
     * GET method for contacts CRUD.
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * UPDATE method for contacts CRUD.
     */
    public function update(Contact $contact) {
        $contact->update($this->validateData());
    }

    /**
     * DELETE method for contact CRUD.
     */
    public function delete(Contact $contact) {
        $contact->delete();
    }

    /**
     * Validate request data.
     */
    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required'
        ]);
    }
}