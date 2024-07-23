<?php

namespace App\Http\Controllers;
use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PositionController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $position = position::all();
            $custom = $request->session()->get('customization');

            return view('home.position', compact('position', 'user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $position = position::where('position_id', $request->search)
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->get();

            if($position){
                return view('home.position', compact('position', 'user'));
            } else{
                return view('home.position', compact('position', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            $positions = position::all()->count();
            
            if($positions >= 5){
                return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium'); 
            }
        }

        try {
            $position = new position();

            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input Position name');}

            do{
                $randomID = mt_rand(10000, 99999);
                $position_id = "POS" . strval($randomID);
            }while($position::where('position_id', $position_id)->exists());

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
            ]);

            $position->position_id = $position_id;
            $position->name = $request->name;
            $position->save();
            return redirect()->back()->with('success', 'Position added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        try {
            $position = position::where('position_id', $request->position_id)->first();
            if($request->name == '' || $request->name == null) {return redirect()->back()->with('error', 'Please input Position name');}
            if(!$position) {return redirect()->back()->with('error', 'Position ID not found');}

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
            ]);

            $position->name = $request->name;
            $position->save();
            return redirect()->back()->with('success', 'Position updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function deleteOne(Request $request){
        try {
            $position = position::where('position_id', $request->position_id)->first();
            if(!$position) {
                return redirect()->back()->with('error', 'Position id not found');
            }
                $position->delete();
                return redirect()->back()->with('success', 'Position deleted successfully');
            } catch(Exception $e) {
                return redirect()->back()->with('error', 'Server Error(500)');
            }
    }
}
