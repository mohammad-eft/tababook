<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\partnerRequests;
use App\Models\phone_code;
use App\Models\role;
use App\Models\role_user;
use Illuminate\Http\Request;
// use App\Models\address;
use App\Models\story;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use IPPanel\Models\Response;
use Log;

class UserController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phoneNumber' => ['required'],
            'password' => ['required'],
            'rules' => ['required'],
            'code'=>['required']
        ], [
            'phoneNumber.required' => 'وارد کردن شماره تلفن الزامی میباشد',
            'password.required' => 'وارد کردن گذرواژه الزامی میباشد',
            'rules.required' => 'پذیرفتن قوانین الزامی میباشد',
            'code.required'=>" وارد کردن کد ارسال شده الزامی میباشد",
        ]);
        if ($request->rules) {
            $phone = User::where('phoneNumber', $request->phoneNumber)->first();
            if ($phone) {
                return redirect()->back()->with('message', 'این شماره تلفن قبلا استفاده شده');
            }
            $password = Hash::make($request->password);
            // $user_id = User::insertGetId([
            // 'phoneNumber' => $request->phoneNumber,
            // 'password' => $password,
            // ]);
            User::upsert([
                'phoneNumber' => $request->phoneNumber,
                'password' => $password,
            ], ['phoneNumber'], ['password']);
            $user_id = User::where('phoneNumber', $request->phoneNumber)->first();
            role_user::create(['role_id' => 2, 'user_id' => $user_id->id]);
            Auth::loginUsingId($user_id->id);
            return to_route('home');
        }
        return to_route('signup');
    }

    public function check(Request $request)
    {
        if ($request->code) {
            $validated = $request->validate([
                'phoneNumber' => ['required'],
                'code' => ['required'],
            ], [
                'phoneNumber.required' => 'وارد کردن شماره تلفن الزامی میباشد',
                'code.required' => 'وارد کردن کد یکبارمصرف الزامی میباشد',
            ]);
        }
        if ($request->password) {
            $validated = $request->validate([
                'phoneNumber' => ['required'],
                'password' => ['required'],
            ], [
                'phoneNumber.required' => 'وارد کردن شماره تلفن الزامی میباشد',
                'password.required' => 'وارد کردن گذرواژه الزامی میباشد',
            ]);
        }

        $user = User::where('phoneNumber', $request->phoneNumber)->whereNotNull('password')->first();

        if ($user) {
            if (isset($request->password)) {
                $checkHash = Hash::check($request->password, $user->password);
                if ($checkHash) {
                    $user->role;
                    Auth::login($user);
                    return to_route('home');
                }
            }
            if (isset($request->code)) {
                $phoneCode = phone_code::where('phoneNumber', $request->phoneNumber)->first();
                if ($phoneCode) {
                    if ($phoneCode->code == $request->code) {
                        $user->role;
                        Auth::login($user);
                        return to_route('home');
                    }
                }
            }
            return to_route('login')->with('error', 'لطفا اطلاعات خود را مجددا بررسی کنید');
        }
        return to_route('signup');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('home');
    }

    public function index()
    {
        $users = User::all();
        $setting = homeSetting::document();
        return view('admin.users.index', ['users' => $users, 'setting' => $setting]);
    }

    public function profile()
    {
        $user = Auth::user();
        $user->role;
        $setting = homeSetting::document();
        return view('profile', ['user' => $user, 'setting' => $setting]);
    }

    public function show(user $user)
    {
        $setting = homeSetting::document();
        return view('admin.users.single', ['user' => $user, 'setting' => $setting]);
    }

    public function edit(user $user)
    {
        $roles = role::all();
        $setting = homeSetting::document();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles, 'setting' => $setting]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        if (isset($request->role)) {
            $role = role_user::where('user_id', $user->id)->delete();
            role_user::create([
                'user_id' => $user->id,
                'role_id' => $request->role
            ]);
        }
        $user->name = $request->name;
        $user->family = $request->family;
        if (isset($request->phoneNumber)) {
            $user->phoneNumber = $request->phoneNumber;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }

        if ($request->password) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }
        if ($request->main_image) {
            if ($user->main_image) {
                Storage::disk('public')->delete($user->main_image);
            }
            $name = $request->main_image->getClientOriginalName();
            $fullName = time() . '_' . $name;
            $path = $request->file('main_image')->storeAs('images', $fullName, 'public');
            $user->main_image = $path;
        }
        $user->save();
        return to_route('user.list', [Auth::user()]);
    }

    public function delete(user $user)
    {
        $user->delete();
        return to_route('user.list');
    }

    public function login()
    {
        return view('login');
    }

    public function compelete_form()
    {
        $setting = homeSetting::document();
        return view('admin.users.compelete_form', ['user' => Auth::user()->roles, 'setting' => $setting]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $user->role;

        // $name = $request->main_image->getClientOriginalName();
        // $fullName = time() . '_' . $name;
        // $path = $request->file('main_image')->storeAs('images', $fullName, 'public');
        // $user->main_image = $path;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->email = $request->email;
        $user->save();
        return to_route('user.profile', [Auth::user()]);
    }

    public function setting()
    {
        $setting = homeSetting::document();
        return view('admin.users.setting', ['setting' => $setting]);
    }

    public function checkAuth(Request $request)
    {
        // $flag = false;
        // $user = User::where('phoneNumber', $request->phoneNumber)->first();
        // $code = phone_code::where('phoneNumber', $request->phoneNumber)->first();
        // if($code && $code->code == $request->code){
        //     $flag = true;
        // }
        $phoneNumber = $request->input('phoneNumber');
        $user = User::where('phoneNumber', $phoneNumber)->first();
        $flag = false;
        if ($user) {
            $flag = true;
        }
        return response()->json(['user' => $user, 'flag' => $flag]);
    }

    public function removeActivationCode(Request $request)
    {
        phone_code::where('phoneNumber', $request->phoneNumber)->delete();
        return response()->json('code deleted');
    }

    public function create_user()
    {
        $roles = role::all();
        $setting = homeSetting::document();
        return view('admin.users.create', ['roles' => $roles, 'setting' => $setting]);
    }

    public function store_user(Request $request)
    {
        $password = Hash::make($request->password);
        // $path = null;
        // if (isset($request->main_image)) {
        //     $name = $request->main_image->getClientOriginalName();
        //     $fullName = time()."_".$name;
        //     $path = $request->file('main_image')->storeAs('images', $fullName, 'public');
        // }
        $user_id = User::insertGetId([
            'name' => $request->name,
            'family' => $request->family,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'password' => $password,
        ]);
        role_user::create([
            'user_id' => $user_id,
            'role_id' => $request->role
        ]);
        return to_route('user.list');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $partner = partnerRequests::where('user_id', $user->id)->where('status', 1)->get();
        $partnerCount = $partner->count();
        $setting = homeSetting::document();
        return view('admin.users.dashboard', ['user' => $user, 'partnerCount' => $partnerCount, 'setting' => $setting]);
    }

    public function sendCode(Request $request)
    {
        $phoneNumber = $request->get('phoneNumber');
        $user = User::where('phoneNumber', $phoneNumber)->first();
        if ($user) {
            return response()->json(false);
        }
        $code = rand(1000, 10000);
        phone_code::upsert(['phoneNumber' => $request->phoneNumber, 'code' => $code], ['phoneNumber'], ['code']);
        $ch = curl_init('https://api.iranpayamak.com/ws/v1/sms/pattern');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Api-Key: M1MIQPQ9s85i6dxdzTeRGx9t87AtRQJlXNiu01e7awuQz94TkI',
            'Content-Type: application/json'
        ]);
        $payload = [
            'code' => '7fvdx77gveizxqn',
            'attributes' => [
                'activation_code' => $code,
            ],
            'recipient' => $request->phoneNumber,
            'line_number' => '50002178584000',
            'number_format' => 'english'
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        return response()->json($response);
    }

    public function checkCode(Request $request)
    {
        $flag = false;
        $phoneCode = phone_code::where('phoneNumber', $request->phoneNumber)->first();
        if ($phoneCode) {
            if ($phoneCode->code == $request->code) {
                $flag = true;
            }
        }
        return response()->json($flag);
    }

    public function checkPassKey(Request $request)
    {
        $flag = false;
        $user = User::where('phoneNumber', $request->phoneNumber)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $flag = true;
            }
        }
        return response()->json($flag);
    }

    public function sendActivationCode(Request $request)
    {
        $phoneNumber = $request->get('phoneNumber');
        $user = User::where('phoneNumber', $phoneNumber)->first();
        if (!$user) {
            return response()->json(false);
        }
        $code = rand(1000, 10000);
        phone_code::upsert(['phoneNumber' => $request->phoneNumber, 'code' => $code], ['phoneNumber'], ['code']);
        $ch = curl_init('https://api.iranpayamak.com/ws/v1/sms/pattern');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Api-Key: M1MIQPQ9s85i6dxdzTeRGx9t87AtRQJlXNiu01e7awuQz94TkI',
            'Content-Type: application/json'
        ]);
        $payload = [
            'code' => '7fvdx77gveizxqn',
            'attributes' => [
                'activation_code' => $code,
            ],
            'recipient' => $request->phoneNumber,
            'line_number' => '50002178584000',
            'number_format' => 'english'
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        return response()->json($response);
    }

    public function about()
    {
        $setting = homeSetting::document();
        return view('about', ['setting' => $setting]);
    }

    public function contact()
    {
        $setting = homeSetting::document();
        return view('contact', ['setting' => $setting]);
    }
}
