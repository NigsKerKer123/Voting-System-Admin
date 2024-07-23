<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partylist;
use Illuminate\Support\Facades\Validator;
use Exception;

class PartylistController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $partylist = partylist::all();
            $custom = $request->session()->get('customization');

            return view('home.partylist', compact('partylist', 'user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $partylist = partylist::where('partylist_id', $request->search)
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->orWhere('acronym', 'like', '%'.$request->search.'%')
                        ->get();

            if($partylist){
                return view('home.partylist', compact('partylist', 'user'));
            } else{
                return view('home.partylist', compact('partylist', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            $party = partylist::all()->count();
            
            if($party >= 2){
                return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium'); 
            }
        }

        try{
            $partylist = new partylist();
            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if(!empty($request->acronym)) {$request->merge(['acronym' => strtoupper($request->input('acronym'))]);}
            
            do{
                $randomID = mt_rand(10000, 99999);
                $partylist_id = "PRTY" . strval($randomID);
            }while($partylist::where('partylist_id', $partylist_id)->exists());

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'acronym' => 'nullable|string|max:5',
            ]);

            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            $partylist->name = $request->name;
            $partylist->acronym = $request->acronym;
            $partylist->partylist_id = $partylist_id;
            $partylist->save();
            return redirect()->back()->with('success', 'Party added successfully');
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        try {
            $partylist = partylist::where('partylist_id', $request->partylist_id)->first();
    
            if(!$partylist) {return redirect()->back()->with('error', 'Party not found');}
            if($request->name == '' || $request->name == null) {return redirect()->back()->with('error', 'Please input name');}
            if(!empty($request->acronym)) {$request->merge(['acronym' => strtoupper($request->input('acronym'))]);}
        
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'acronym' => 'nullable|string|max:5',
            ]);
        
            if($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            }
        
            $partylist->name = $request->name;
            $partylist->acronym = $request->acronym;
            $partylist->save();
            return redirect()->back()->with('success', 'Party updated successfully');
    
            } catch(Exception $e) {
                return redirect()->back()->with('error', 'Server Error(500)');
            }
    }

    function deleteOne(Request $request){
        try {
        $partylist = partylist::where('partylist_id', $request->partylist_id)->first();

        if(!$partylist) {
            return redirect()->back()->with('error', 'Party not found');
        }
            $partylist->delete();
            return redirect()->back()->with('success', 'Party deleted successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
