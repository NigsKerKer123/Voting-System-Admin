<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class votesController extends Controller
{
    function ssc(Request $request){
        try{
            $user = $request->session()->get('user');
            $custom = $request->session()->get('customization');
            return view('home.sscVotes', compact('user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function sbo(Request $request){
        try{
            $user = $request->session()->get('user');
            $custom = $request->session()->get('customization');
            return view('home.sboVotes', compact('user', 'custom'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
