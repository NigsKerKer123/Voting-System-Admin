<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\tenant_user;
use App\Models\domain;
use App\Models\customization;
use Exception;

class adminController extends Controller
{
    function login(Request $request){

        try {
            $user = User::where('email', $request->email)->first();
            $tenant_user = tenant_user::where('user_id', $user->id)->first();
            $domain = domain::where('tenant_id', $tenant_user->tenant_id)->first();

            $subdomain = $domain->domain;

            if(!$user){
                return redirect()->back()->with('error', 'Admin not found!');
            }
    
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                $request->session()->put('user', $user);
                return redirect("http://" . $subdomain . "." . "campuschoice.com:8000/dashboard");
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function logout(){
        try {
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function dashboard(Request $request){
        try {
            $user = $request->session()->get('user');
            $customization = customization::all();
            $request->session()->put('customization', $customization);
            $custom = $request->session()->get('customization');

            return view('home.dashboard', compact('user', 'custom'));
        } catch (Exception $e) {
            // return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'subscription' => 'required|string|in:1,2',
            'subdomain' => 'required|string|unique:domains,domain',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid input');
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->subscription = $request->subscription;
            $user->save();

            $tenant = Tenant::create([
                'name' => $request->name,
            ]);

            $tenant->domains()->create(['domain' => $request->subdomain]);
            $user->tenants()->attach($tenant->id);

            Auth::login($user);
            $request->session()->put('user', $user);

            return redirect("http://" . $request->subdomain . "." . "campuschoice.com:8000/dashboard");
        } catch (Exception $e) {
            // return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function registerIndex(){
        try {
            return view('register');
        } catch (Exception $e) {
            // return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function customize(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium..'); 
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:100',
            'logo' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid input');
        }

        try {
            $customization = customization::where('id', 1)->first();

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');

                $subdomain = explode('.', $request->getHost())[0];
                $imageName = 'logo' . $subdomain . '.' . $image->getClientOriginalExtension();
                
                $image->move(public_path('images'), $imageName);
                $customization->logo_pic = $imageName;
            }
            $customization->logo_name = $request->name;
            $customization->save();

            return back()->with('success', 'Updated successfully.');
        } catch (Exception $e) {
            // return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function upgrade(Request $request){
        try {
            $user = $request->session()->get('user');
            
            if($user->subscription != "1"){
                return redirect()->back()->with('error', 'You are already in premium services');
            }
            else{
                $userDB = User::where('id', $user->id)->first();
                $userDB->subscription = '2';
                $userDB->save();

                $user->subscription = '2';
                return back()->with('success', 'Thank you for subcribing to premium services.'); 
            }
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
