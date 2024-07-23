<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\college;
use Illuminate\Support\Facades\Validator;
use Exception;

class CollegeController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $colleges = college::all();
            $custom = $request->session()->get('customization');
            return view('home.college', compact('colleges', 'user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $colleges = College::where('college_id', $request->search)
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->orWhere('acronym', 'like', '%'.$request->search.'%')
                        ->get();

            if($colleges){
                return view('home.college', compact('colleges', 'user'));
            } else{
                return view('home.college', compact('colleges', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        try{
        $college = new college();

        //Validation ni diri
        if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
        if($request->acronym == '' | $request->acronym == null){return redirect()->back()->with('error', 'Please input acronym');}
        
        //force to capitalize case
        $request->merge(['acronym' => strtoupper($request->input('acronym'))]);

        //To ensure the collegeID is unique
        do{
            $randomID = mt_rand(10000, 99999);
            $collegeId = "COL" . strval($randomID);
        }while($college::where('college_id', $collegeId)->exists());

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'acronym' => 'string|max:5',
        ]);

        if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

        $college->name = $request->name;
        $college->acronym = $request->acronym;
        $college->college_id = $collegeId;
        $college->save();
        return redirect()->back()->with('success', 'College added successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        // Find the college record by ID
        try {
        $college = college::where('college_id', $request->collegeID)->first();

        if(!$college) {return redirect()->back()->with('error', 'College not found');}
        if($request->name == '' || $request->name == null) {return redirect()->back()->with('error', 'Please input name');}
        if($request->acronym == '' || $request->acronym == null) {return redirect()->back()->with('error', 'Please input acronym');}
    
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'acronym' => 'string|max:5',
        ]);
    
        if($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid input');
        }
    
        $college->name = $request->name;
        $college->acronym = $request->acronym;
        $college->save();
        return redirect()->back()->with('success', 'College updated successfully');

        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }    

    function deleteOne(Request $request){
        // Find the college record by ID
        try {
        $college = college::where('college_id', $request->collegeID)->first();

        // Check if the college record exists
        if(!$college) {
            return redirect()->back()->with('error', 'College not found');
        }
            // Delete the college record
            $college->delete();
            return redirect()->back()->with('success', 'College deleted successfully');
        } catch(Exception $e) {
            // Handle server error
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
