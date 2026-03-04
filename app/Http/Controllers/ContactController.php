<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        // Save to database
        Message::create($data);

        // Send email
        Mail::to('kaungpyaethaintun@gmail.com')
            ->send(new ContactMail($data));

        return back()->with('success', 'Thank you! Your message has been sent.');
    }
}