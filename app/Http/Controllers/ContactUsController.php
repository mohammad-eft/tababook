<?php

namespace App\Http\Controllers;
use App\Models\contactUs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('client.contactUs.create');
    }

    public function store(Request $request)
    {
        contactUs::create([
            'user_id'=>Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber
        ]);
        return to_route('contactUs.myMessage');
    }

    public function index()
    {
        $allContactUs = contactUs::all();
        return view('admin.contactUs.index', ['allContactUs' => $allContactUs]);
    }
    public function single(contactUs $contactUs)
    {
        return view('admin.contactUs.single', ['contactUs' => $contactUs]);
    }
    public function clientSingle(contactUs $contactUs)
    {
        return view('client.contactUs.show', ['contactUs' => $contactUs]);
    }
    public function myMessage()
    {
        return view('client.contactUs.myMessage');
    }

    public function edit(contactUs $contactUs)
    {
        return view('client.contactUs.edit', ['contactUs' => $contactUs]);
    }

    public function update(Request $request)
    {
        $contactUs = contactUs::find($request->id);
        $contactUs->title = $request->title;
        $contactUs->description = $request->description;
        $contactUs->phoneNumber = $request->phoneNumber;
        $contactUs->save();
        return to_route('contactUs.myMessage');
    }

    public function delete(contactUs $contactUs)
    {
        $contactUs->delete();
        return to_route('contactUs.myMessage');
    }
     public function deleteAll(Request $request)
    {
        foreach($request->allContactUs as $contactUs){
            $contactUs = contactUs::find($contactUs);
        }
        $contactUs->delete();
        return redirect()->back();
    }
}
