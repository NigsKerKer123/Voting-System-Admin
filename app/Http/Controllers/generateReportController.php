<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\casted;
use App\Models\candidate;
use App\Models\college;
use App\Models\voters;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class generateReportController extends Controller
{
    function generate(Request $request){
        try{
            $castedVote = casted::all()->count();
            $voters = voters::all()->count();
            $message = $request->report == 1 ? "UNOFFICIAL RESULT" : "FINAL RESULT";

            //SSC
            $pres = $this->president();
            $vice_pres = $this->vice_pres();
            $sen = $this->senators();

            $data = [
                'message' => $message,
                'casted' => $castedVote,
                'voter' => $voters,
                'date' => date('m/d/Y'),
                'pres' => $pres,
                'vice_pres' => $vice_pres,
                'sen' => $sen,
            ];
    
            $pdf = PDF::loadView('components.ssc', $data);
            return $pdf->stream('SSC_reports.pdf');
            
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function generateSBO(Request $request){
        try{
            $college_id = $request->college_id;
            $user = $request->session()->get('user');

            $voters = voters::where('college', $request->college)->count();

            $numberCasted = voters::where('cast', true)->get();

            $sboNumberCasted = 0;

            foreach($numberCasted as $numberCastedData){
                if($numberCastedData->college == $request->college){
                    $sboNumberCasted++;
                }
            }
            
            $message = $request->report == 1 ? "UNOFFICIAL RESULT" : "FINAL RESULT";

            //sbo
            $gov_id = $this->governor();
            $viceGov_id = $this->vice_gov();
            $sec_id = $this->secretary();
            $assSec_id = $this->ass_secretary();
            $treasurer_id = $this->treasurer();
            $ass_treasurer_id = $this->ass_treasurer();
            $auditor_id = $this->auditor();
            $pro_id = $this->PRO();
            $second_id = $this->second();
            $third_id = $this->third();
            $fourth_id = $this->fourth();

            $data = [
                'message' => $message,
                'voter' => $voters,
                'casted' => $sboNumberCasted,

                'date' => date('m/d/Y'),

                'gov' => isset($gov_id[$college_id]) ? $gov_id[$college_id] : null,
                'vice_gov' => isset($viceGov_id[$college_id]) ? $viceGov_id[$college_id] : null,
                'sec' => isset($sec_id[$college_id]) ? $sec_id[$college_id] : null,
                'ass_sec' => isset($assSec_id[$college_id]) ? $assSec_id[$college_id] : null,
                'tres' => isset($treasurer_id[$college_id]) ? $treasurer_id[$college_id] : null,
                'ass_tres' => isset($ass_treasurer_id[$college_id]) ? $ass_treasurer_id[$college_id] : null,
                'audit' => isset($auditor_id[$college_id]) ? $auditor_id[$college_id] : null,
                'pro' => isset($pro_id[$college_id]) ? $pro_id[$college_id] : null,
                'second' => isset($second_id[$college_id]) ? $second_id[$college_id] : null,
                'third' => isset($third_id[$college_id]) ? $third_id[$college_id] : null,
                'fourth' => isset($fourth_id[$college_id]) ? $fourth_id[$college_id] : null,
                "college" => $request->college,
            ];
    
            $pdfSBO = PDF::loadView('components.sbo', $data);
            return $pdfSBO->stream('SBO_report.pdf');
            
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    //president
    function president(){
            $castedAll = casted::all();
            $numberOfCastVotes = $castedAll->count();
            
            $president = Candidate::where('position_id', 'POS50723')->get();
            $Result = [];

            foreach($president as $presidentData){
                $presidentData->student_id;
                $count = casted::where('president', $presidentData->student_id)->count();

                $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;

                $Result[] = [
                    'student_id' => $presidentData->student_id,
                    'name' => $presidentData->name,
                    'position' => $presidentData->position,
                    'votes' => $count,
                    'party' => $presidentData->partylist,
                    'percentage' => round($percentage, 2) . '%',
                    'rank' => 0
                ];
            }

            // Sort the presResult array by votes in descending order
            usort($Result, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });

            // Assign ranks
            $rank = 1;
            foreach ($Result as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }

            return $Result;
    }

    //vice pres
    function vice_pres(){
        $castedAll = casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $vice_pres = Candidate::where('position_id', 'POS71962')->get();
        $Result = [];

        foreach($vice_pres as $vice_presData){
            $vice_presData->student_id;
            $count = casted::where('vice_president', $vice_presData->student_id)->count();

            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;

            $Result[] = [
                'student_id' => $vice_presData->student_id,
                'name' => $vice_presData->name,
                'position' => $vice_presData->position,
                'votes' => $count,
                'party' => $vice_presData->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
        }

        // Sort the presResult array by votes in descending order
        usort($Result, function($a, $b) {
            return $b['votes'] <=> $a['votes'];
        });

        // Assign ranks
        $rank = 1;
        foreach ($Result as &$result) {
            $result['rank'] = $rank;
            $rank++;
        }

        return $Result;
    }

    //
    function senators(){
        // Get total number of cast votes
        $numberOfCastVotes = casted::count();
        
        // Fetch all records from the casted table
        $castedVotes = casted::all();
        
        // Initialize an empty array to store the counts for each senator
        $senatorCounts = [];
        
        foreach($castedVotes as $castedVote){
            // Decode the serialized JSON string to an array
            $senatorIds = json_decode($castedVote->senators, true) ?? [];
    
            // Increment the count for each senator
            foreach ($senatorIds as $senatorId) {
                if (!isset($senatorCounts[$senatorId])) {
                    $senatorCounts[$senatorId] = 0;
                }
                $senatorCounts[$senatorId]++;
            }
        }
    
        $senators = Candidate::where('position_id', 'POS27724')->get();
        $Result = [];
    
        foreach($senators as $senatorData){
            // Get the count for the current senator from the $senatorCounts array
            $count = $senatorCounts[$senatorData->student_id] ?? 0;
    
            // Avoid division by zero
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $Result[] = [
                'student_id' => $senatorData->student_id,
                'name' => $senatorData->name,
                'position' => $senatorData->position,
                'votes' => $count,
                'party' => $senatorData->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
        }
    
        // Sort the $Result array by votes in descending order
        usort($Result, function($a, $b) {
            return $b['votes'] <=> $a['votes'];
        });
    
        // Assign ranks
        $rank = 1;
        foreach ($Result as &$result) {
            $result['rank'] = $rank;
            $rank++;
        }
    
        return $Result;
    }    

    //Governor
    function governor(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $governors = Candidate::where('position_id', 'POS30722')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($governors as $data){
            $count = Casted::where('governor', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //vice governor
    function vice_gov(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS15836')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('vice_governor', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //secretary
    function secretary(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS71264')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('secretary', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //ass secretary
    function ass_secretary(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS70389')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('associate_secretary', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //treasurer
    function treasurer(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS77261')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('treasurer', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //Ass treasurer
    function ass_treasurer(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS31200')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('associate_treasurer', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //Ass auditor
    function auditor(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS20338')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('auditor', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //PRO
    function PRO(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS49266')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('public_relation_officer', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //2nd rep
    function second(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS32377')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('2nd_year_rep', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //3rd rep
    function third(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS12268')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('3rd_year_rep', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }

    //4th rep
    function fourth(){
        $castedAll = Casted::all();
        $numberOfCastVotes = $castedAll->count();
        
        $candidate = Candidate::where('position_id', 'POS19029')->get();
    
        // Initialize an associative array to store candidates grouped by college_id
        $collegeResults = [];
    
        foreach($candidate as $data){
            $count = Casted::where('4th_year_rep', $data->student_id)->count();
    
            $percentage = $numberOfCastVotes > 0 ? ($count / $numberOfCastVotes) * 100 : 0;
    
            $result = [
                'student_id' => $data->student_id,
                'name' => $data->name,
                'position' => $data->position,
                'college' => $data->college,
                'college_id' => $data->college_id,
                'votes' => $count,
                'party' => $data->partylist,
                'percentage' => round($percentage, 2) . '%',
                'rank' => 0
            ];
    
            // Group the result by college_id
            if (!isset($collegeResults[$data->college_id])) {
                $collegeResults[$data->college_id] = [];
            }
    
            $collegeResults[$data->college_id][] = $result;
        }
    
        // Sort each college's results by votes in descending order
        foreach ($collegeResults as &$results) {
            usort($results, function($a, $b) {
                return $b['votes'] <=> $a['votes'];
            });
    
            // Assign ranks
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank;
                $rank++;
            }
        }
    
        return $collegeResults;
    }
}
