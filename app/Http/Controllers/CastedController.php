<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\casted;
use App\Models\candidate;
use App\Models\voters;
use Exception;

class CastedController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $casted = casted::paginate(25);
            $custom = $request->session()->get('customization');

            return view('home.castedVotes', compact('user', 'casted', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
