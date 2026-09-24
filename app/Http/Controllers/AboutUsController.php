<?php

namespace App\Http\Controllers;

use App\Models\aboutUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\classes\homeSetting;

class AboutUsController extends Controller
{
    public function create_edit(aboutUs $aboutUs = null)
    {
        $setting = homeSetting::document();
        return view('admin.aboutUs.create', ['aboutUs' => $aboutUs, 'setting'=>$setting]);
    }

    public function updateOrcreate(Request $request)
    {
        aboutUs::upsert([
            'id' => isset($request->id) ? $request->id : 1,
            'title' => $request->title,
            'description' => $request->description],
            ['id'], // unique
            ['title', 'description']);

        return to_route('aboutUs.list');
    }

    public function index()
    {
        $allAboutUs = aboutUs::all();
        $setting = homeSetting::document();
        return view('admin.aboutUs.index', ['allAboutUs' => $allAboutUs, 'setting'=>$setting]);
    }

    public function delete(aboutUs $aboutUs)
    {
        $aboutUs->delete();
        return redirect('/aboutUs/aboutUs');
    }

    public function clientList()
    {
        $aboutUs = aboutUs::first();
        $setting = homeSetting::document();
        return view("about", ['aboutUs' => $aboutUs, 'setting'=>$setting]);
    }
}
