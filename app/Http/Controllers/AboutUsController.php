<?php

namespace App\Http\Controllers;

use App\Models\aboutUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function create_edit(aboutUs $aboutUs = null)
    {
        return view('admin.aboutUs.create', ['aboutUs' => $aboutUs]);
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
        return view('admin.aboutUs.index', ['allAboutUs' => $allAboutUs]);
    }

    public function delete(aboutUs $aboutUs)
    {
        $aboutUs->delete();
        return redirect('/aboutUs/aboutUs');
    }

    public function clientList()
    {
        $aboutUs = aboutUs::all();
        return view("client.aboutUs.aboutUsList", ['aboutUs' => $aboutUs]);
    }
}
