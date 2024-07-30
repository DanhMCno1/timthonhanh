<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        return view('users.contact');
    }

    public  function send(ContactRequest $request)
    {
        Contact::create($request->all());
        return response()->json(['status' => 'successful']);
    }
}
