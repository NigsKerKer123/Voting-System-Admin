<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\organization;
use Illuminate\Support\Facades\Validator;
use Exception;

class OrganizationController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $organization = organization::all();
            $custom = $request->session()->get('customization');

            return view('home.organization', compact('organization', 'user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $organization = organization::where('organization_id', $request->search)
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->orWhere('acronym', 'like', '%'.$request->search.'%')
                        ->get();

            if($organization){
                return view('home.organization', compact('organization', 'user'));
            } else{
                return view('home.organization', compact('organization', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            $organization = organization::all()->count();
            
            if($organization >= 1){
                return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium'); 
            }
        }

        try {
            $organization = new organization();

            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->acronym == '' | $request->acronym == null){return redirect()->back()->with('error', 'Please input organization acronym');}

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'acronym' => 'string|max:255',
            ]);
            
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            do{
                $randomID = mt_rand(10000, 99999);
                $organization_id = "ORG" . strval($randomID);
            }while($organization::where('organization_id', $organization_id)->exists());

            $organization->organization_id = $organization_id;
            $organization->name = $request->name;
            $organization->acronym = $request->acronym;
            $organization->save();
            return redirect()->back()->with('success', 'Organization added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        try {
            $organization = organization::where('organization_id', $request->organization_id)->first();

            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->acronym == '' | $request->acronym == null){return redirect()->back()->with('error', 'Please input organization acronym');}

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'acronym' => 'string|max:255',
            ]);
            
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            $organization->name = $request->name;
            $organization->acronym = $request->acronym;
            $organization->save();
            return redirect()->back()->with('success', 'Organization updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function deleteOne(Request $request){
       try {
        $organization = organization::where('organization_id', $request->organization_id)->first();

        if(!$organization) {
            return redirect()->back()->with('error', 'Organization not found');
        }
            !$organization->delete();
            return redirect()->back()->with('success', 'Organization deleted successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
