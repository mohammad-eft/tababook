<?php

namespace App\Http\Controllers;
use App\Models\contactUs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\classes\homeSettin;
class ContactUsController extends Controller
{
    public function create()
    {
        $setting = homeSetting::document();
        return view('client.contactUs.create', ['setting'=>$setting]);
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
        $setting = homeSetting::document();
        return view('admin.contactUs.index', ['allContactUs' => $allContactUs, 'setting'=>$setting]);
    }
    public function single(contactUs $contactUs)
    {
        $setting = homeSetting::document();
        return view('admin.contactUs.single', ['contactUs' => $contactUs, 'setting'=>$setting]);
    }
    public function clientSingle(contactUs $contactUs)
    {
        $setting = homeSetting::document();
        return view('client.contactUs.show', ['contactUs' => $contactUs, 'setting'=>$setting]);
    }
    public function myMessage()
    {
        $setting = homeSetting::document();
        return view('client.contactUs.myMessage', ['setting'=>$setting]);
    }

    public function edit(contactUs $contactUs)
    {
        $setting = homeSetting::document();
        return view('client.contactUs.edit', ['contactUs' => $contactUs,'setting'=>$setting]);
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
