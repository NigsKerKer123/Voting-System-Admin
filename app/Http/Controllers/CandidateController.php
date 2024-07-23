<?php

namespace App\Http\Controllers;

use App\Models\college;
use App\Models\partylist;
use App\Models\position;
use App\Models\organization;
use App\Models\candidate;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $candidate = candidate::paginate(25);
            $colleges = college::all();
            $partylist = partylist::all();
            $position = position::all();
            $organization = organization::all();
            $custom = $request->session()->get('customization');

            return view('home.candidates', compact('candidate', 'colleges', 'partylist', 'position', 'organization', 'user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $colleges = college::all();
            $partylist = partylist::all();
            $position = position::all();
            $organization = organization::all();
            $candidate = candidate::where('student_id', $request->search)
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->orWhere('organization', 'like', '%'.$request->search.'%')
                        ->orWhere('course', 'like', '%'.$request->search.'%')
                        ->orWhere('college', 'like', '%'.$request->search.'%')
                        ->orWhere('partylist', 'like', '%'.$request->search.'%')
                        ->orWhere('position', 'like', '%'.$request->search.'%')
                        ->paginate(25);

            if($candidate){
                return view('home.candidates', compact('candidate', 'colleges', 'partylist', 'position', 'organization', 'user'));
            } else{
                return view('home.candidates', compact('candidate', 'colleges', 'partylist', 'position', 'organization', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            $candidate = candidate::all()->count();
            
            if($candidate >= 10){
                return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium'); 
            }
        }

        try {
            $candidate = new candidate();
            $college = college::where('college_id', $request->college_id)->first();
            $partylist = partylist::where('partylist_id', $request->partylist_id)->first();
            $position = position::where('position_id', $request->position_id)->first();
            $organization = organization::where('organization_id', $request->organization_id)->first();
            
            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->student_id == '' | $request->student_id == null){return redirect()->back()->with('error', 'Please input student iD');}
            if($request->course == '' | $request->course == null){return redirect()->back()->with('error', 'Please input course');}

            if(!$college){return redirect()->back()->with('error', 'please select college');}
            if(!$organization){return redirect()->back()->with('error', 'please select organization');}
            if(!$partylist){return redirect()->back()->with('error', 'please select party');}
            if(!$position){return redirect()->back()->with('error', 'please select position');}
            
            $validator = Validator::make($request->all(), [
                'student_id' => 'string|max:100',
                'name' => 'string|max:255',
                'course' => 'string|max:100',
                'college_id' => 'string|max:100',
                'organization_id' => 'string|max:100',
                'partylist_id' => 'string|max:100',
                'position_id' => 'string|max:100',
            ]);
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            $validatorAlreadyExist = Validator::make($request->all(), ['student_id' => 'unique:candidates,student_id',]);
            if($validatorAlreadyExist->fails()){return redirect()->back()->with('error', 'Student ID already exists.');}
            
            $request->merge(['name' => strtoupper($request->input('name'))]);

            $candidate->student_id = $request->student_id;
            $candidate->picture_id = "PIC".$request->student_id;
            $candidate->name = $request->name;
            $candidate->course = $request->course;
            $candidate->college = $college->name." (".$college->acronym.")";
            $candidate->organization = $organization->name;
            $candidate->partylist = $partylist->name;
            $candidate->position = $position->name;
            $candidate->college_id = $college->college_id;
            $candidate->organization_id = $organization->organization_id;
            $candidate->partylist_id = $partylist->partylist_id;
            $candidate->position_id = $position->position_id;
            $candidate->save();

            error_log($candidate->name . " is saved in the database!"); //Pang monitor lang

            return redirect()->back()->with('success', 'Candidate added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        try {
            $candidate = candidate::where('student_id', $request->findID)->first();
            $college = college::where('college_id', $request->college_id)->first();
            $partylist = partylist::where('partylist_id', $request->partylist_id)->first();
            $position = position::where('position_id', $request->position_id)->first();
            $organization = organization::where('organization_id', $request->organization_id)->first();
            
            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->student_id == '' | $request->student_id == null){return redirect()->back()->with('error', 'Please input student iD');}
            if($request->course == '' | $request->course == null){return redirect()->back()->with('error', 'Please input course');}
            
            if(!$candidate){return redirect()->back()->with('error', 'invalid find ID');}
            if(!$college){return redirect()->back()->with('error', 'please select college');}
            if(!$organization){return redirect()->back()->with('error', 'please select organization');}
            if(!$partylist){return redirect()->back()->with('error', 'please select party');}
            if(!$position){return redirect()->back()->with('error', 'please select position');}
            
            $validator = Validator::make($request->all(), [
                'student_id' => 'string|max:100',
                'name' => 'string|max:255',
                'course' => 'string|max:100',
                'college_id' => 'string|max:100',
                'organization_id' => 'string|max:100',
                'partylist_id' => 'string|max:100',
                'position_id' => 'string|max:100',
            ]);
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            $validatorAlreadyExist = Validator::make($request->all(),[Rule::unique('candidates', 'student_id')->ignore($candidate->id),]);
            if($validatorAlreadyExist->fails()){return redirect()->back()->with('error', 'Student ID already exists.');}

            $request->merge(['name' => strtoupper($request->input('name'))]);
            
            $candidate->student_id = $request->student_id;
            $candidate->picture_id = "PIC".$request->student_id;
            $candidate->name = $request->name;
            $candidate->course = $request->course;
            $candidate->college = $college->name." (".$college->acronym.")";
            $candidate->organization = $organization->name;
            $candidate->partylist = $partylist->name;
            $candidate->position = $position->name;
            $candidate->college_id = $college->college_id;
            $candidate->organization_id = $organization->organization_id;
            $candidate->partylist_id = $partylist->partylist_id;
            $candidate->position_id = $position->position_id;
            $candidate->save();
            return redirect()->back()->with('success', 'Candidate updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function deleteOne(Request $request){
        try {
            $candidate = candidate::where('student_id', $request->student_id)->first();
            if(!$candidate) {
                return redirect()->back()->with('error', 'Candidate not found');
            }
            $candidate->delete();
            return redirect()->back()->with('success', 'Candidate deleted successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
