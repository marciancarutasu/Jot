<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    /**
     * POST single contact.;
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required'
        ]);

        Contact::create($data);
    }

    /**
     * GET single contact by id
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    // /**
    //  * UPDATE method for contacts CRUD.
    //  */
    // public function update(Contact $contact) {
    //     $contact->update($this->validateData());
    // }

    // /**
    //  * DELETE method for contact CRUD.
    //  */
    // public function delete(Contact $contact) {
    //     $contact->delete();
    // }

    // /**
    //  * Validate request data.
    //  */
    // private function validateData()
    // {
    //     return request()->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'birthday' => 'required',
    //         'company' => 'required'
    //     ]);
    // }
}