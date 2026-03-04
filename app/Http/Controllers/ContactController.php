<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request)
    {
        Message::create($request->validated());

        return back()->
            with('success', 'Thank you! Your message has been sent.');
    }
}