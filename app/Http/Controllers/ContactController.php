<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
     public function index()
    {
        return view('Frontend.Contact');
    }

    public function storeContact(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'subject' => ['required', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:500'],
    ]);

    Contact::insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);
     return redirect()->back();
}

public function contactMessage(){
    $contacts = Contact::latest()->get();
    return view('Backend.Contact.allContact', compact('contacts'));
}
public function contactDelete($id){
    Contact::findOrFail($id)->delete();
    return redirect()->back();
}
}
