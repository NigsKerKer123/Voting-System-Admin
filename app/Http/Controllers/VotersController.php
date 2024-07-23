<?php

namespace App\Http\Controllers;

use App\Mail\PasskeyMail;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\college;
use App\Models\voters;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

use App\Models\new_voter;

class VotersController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $colleges = college::all();
            $voters = voters::paginate(25);
            $custom = $request->session()->get('customization');

            return view('home.voters', compact('colleges', 'voters', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function search(Request $request){
        try{
            $user = $request->session()->get('user');
            $colleges = college::all();

            $voters = voters::where('student_id', $request->search)
                        ->orWhere('email', 'like', '%'.$request->search.'%')
                        ->orWhere('name', 'like', '%'.$request->search.'%')
                        ->orWhere('course', 'like', '%'.$request->search.'%')
                        ->orWhere('college', 'like', '%'.$request->search.'%')
                        ->orWhere('cast', 'like', '%'.$request->search.'%')
                        ->paginate(25);
            if($voters){
                return view('home.voters', compact('colleges', 'voters', 'user'));
            } else{
                return view('home.voters', compact('colleges', 'voters', 'user'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            $voters = voters::all()->count();
            
            if($voters >= 100){
                return redirect()->back()->with('error', 'You are in Free Services only please upgrade to premium'); 
            }
        }

        try{
            $voter = new voters();
            $college = college::where('college_id', $request->college)->get('acronym')->first();
            
            //Validation ni diri
            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->student_id == '' | $request->student_id == null){return redirect()->back()->with('error', 'Please input student id');}
            if($request->email == '' | $request->email == null){return redirect()->back()->with('error', 'Please input email');}
            if($request->course == '' | $request->course == null){return redirect()->back()->with('error', 'Please input course');}
            if($college == '' | $college == null){return redirect()->back()->with('error', 'Please select college');}
            if(!$college){return redirect()->back()->with('error', 'Invalid input');}
           
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'student_id' => 'string|max:255',
                'email' => 'string|max:255',
                'course' => 'string|max:255',
            ]);
            
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            $validatorAlreadyExist = Validator::make($request->all(), [
                'student_id' => 'unique:user,student_id',
                'email' => 'unique:user,email',
            ]);

            if($validatorAlreadyExist->fails()){
                if ($validatorAlreadyExist->errors()->has('student_id')) {
                    return redirect()->back()->with('error', 'Student ID already exists.');
                }
                return redirect()->back()->with('error', 'email already exists.');
            }
            
            //to ensure na dili mag pareha ang passkey
            do{
                //mo generate ni siyag 5 random hexadecimal
                $passkey = $college->acronym . Str::random(6);
            }while($voter::where('passkey', $passkey)->exists());

            
            //Method pang send og mail
            // try {
            //     $this->sendPasskeyMail($request->email, $request->name, $passkey);
            // } catch (Exception $e) {
            //     return redirect()->back()->with('error', 'Unable to send email!');
            // }
            
            $voter->name = $request->name;
            $voter->student_id = $request->student_id;
            $voter->email = $request->email;
            $voter->course = $request->course;
            $voter->college = $college->acronym;
            $voter->passkey = Hash::make($passkey);
            $voter->save();

            return redirect()->back()->with('success', 'Voter registered successfully. ' . $passkey);
            }catch(Exception $e){
                return $e;
                return redirect()->back()->with('error', 'Server Error(500)');
            }
    }

    function edit(Request $request){
        try{
            $voter = voters::where('student_id', $request->findID)->first();
            $college = college::where('college_id', $request->college)->get('acronym')->first();

            //Validation ni diri
            if($request->name == '' | $request->name == null){return redirect()->back()->with('error', 'Please input name');}
            if($request->student_id == '' | $request->student_id == null){return redirect()->back()->with('error', 'Please input student id');}
            if($request->email == '' | $request->email == null){return redirect()->back()->with('error', 'Please input email');}
            if($request->course == '' | $request->course == null){return redirect()->back()->with('error', 'Please input course');}
            if($college == '' | $college == null){return redirect()->back()->with('error', 'Please select college');}
            if(!$college){return redirect()->back()->with('error', 'Invalid input');}
            if(!$voter) {return redirect()->back()->with('error', 'Voter not found');}
            
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'student_id' => 'string|max:255',
                'email' => 'string|max:255',
                'course' => 'string|max:255',
            ]);
            if($validator->fails()){return redirect()->back()->with('error', 'Invalid input');}

            //para e ignore ang current voter id
            $validatorAlreadyExist = Validator::make($request->all(), [
                Rule::unique('user', 'student_id')->ignore($voter->id),
                Rule::unique('user', 'email')->ignore($voter->id),
            ]);

            if($validatorAlreadyExist->fails()){
                if ($validatorAlreadyExist->errors()->has('student_id')) {
                    return redirect()->back()->with('error', 'Student ID already exists.');
                }
                return redirect()->back()->with('error', 'email already exists.');
            }

            $voter->name = $request->name;
            $voter->student_id = $request->student_id;
            $voter->email = $request->email;
            $voter->course = $request->course;
            $voter->college = $college->acronym;
            $voter->save();
            return redirect()->back()->with('success', 'Voter updated successfully!');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function deleteOne(Request $request){
        try {
            $voter = voters::where('student_id', $request->student_id)->first();
            if(!$voter) {
                return redirect()->back()->with('error', 'Voter not found');
            }
            $voter->delete();
            return redirect()->back()->with('success', 'voter deleted successfully');
        }catch(Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    private function sendPasskeyMail($toEmail, $name ,$passkey){
        $message = "Hi " . $name . ", Welcome to buksu Comelec 2024";
        Mail::to($toEmail)->send(new PasskeyMail($message, $passkey));
    }

    //! Regenerate Passkey wala pa na human kay kapoy
    function regeneratePasskey(Request $request){
        try {
            $voter = voters::where('student_id', $request->student_id)->first();
            $college = voters::where('student_id', $request->student_id)->get('college')->first();

            if(!$voter){
                return redirect()->back()->with('error', 'Student doesnt exist');
            }

            do{
                //mo generate ni siyag 5 random hexadecimal
                $passkey = $college["college"] . Str::random(6);
            }while($voter::where('passkey', $passkey)->exists());


            // $this->sendPasskeyMail($voter->email, $voter->name, $passkey);
            $voter->passkey = Hash::make($passkey);
            $voter->save();
            return redirect()->back()->with('success', 'voter passkey sent! ' . $passkey);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to send email!(500)');
        }
    }

    function hash(){
        try {
            return $new_voter = new_voter::all();
            $voterNotHashed = [];
            
            foreach($new_voter as $voterdata){
                if (Hash::needsRehash($voterdata->passkey)) {
                    $voterdata->passkey = Hash::make($voterdata->passkey);
                    $voterdata->save();
                } else{
                    $voterNotHashed[] = $voterdata->passkey;
                }
            }

            return $voterNotHashed;
        } catch (Exception $e) {
            return $e;
        }
    }

    function balhin(){
        try {
            return $new_voter = new_voter::all();

            foreach ($new_voter as $new_voterData){
                // Check if student_id already exists
                $existingVoter = voters::where('student_id', $new_voterData->student_id)->first();
    
                if (!$existingVoter) {
                    $voter = new voters();
    
                    $voter->name = $new_voterData->name;
                    $voter->student_id = $new_voterData->student_id;
                    $voter->email = $new_voterData->email;
                    $voter->course = $new_voterData->course;
                    $voter->college = $new_voterData->college;
                    $voter->passkey = $new_voterData->passkey;
                    $voter->cast = false;
                    $voter->save();
                }
            }
            return "goods!";

        } catch (Exception $e) {
            return $e;
        }
    }    
}
