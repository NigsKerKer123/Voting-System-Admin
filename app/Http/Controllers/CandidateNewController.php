<?php

namespace App\Http\Controllers;
use App\Models\college;
use App\Models\partylist;
use App\Models\position;
use App\Models\organization;
use App\Models\candidate;
use App\Models\candidate_new;
use App\Models\voters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class CandidateNewController extends Controller
{
    function migrate(){
        try {
            $candidate = new candidate();
            $college = college::all();
            $partylist = partylist::all();
            $position = position::all();
            $organization = organization::all();
            $candidate_new = candidate_new::all();
            
            foreach($candidate_new as $candidate_new_data){
                $candidate = new candidate();
                $candidate->student_id = $candidate_new_data->candidate_id;
                $candidate->picture_id = "PIC".$candidate_new_data->candidate_id;
                $candidate->course =  $candidate_new_data->course;
                $candidate->college =  $candidate_new_data->college;
                $candidate->organization = $candidate_new_data->organization;
                $candidate->partylist = $candidate_new_data->party;
                $candidate->position = $candidate_new_data->position;
                
                foreach($college as $collegeData){
                    if($collegeData->name == $candidate_new_data->college)
                    {
                        $candidate->college_id = $collegeData->college_id;
                    }
                }

                foreach($partylist as $partylistData){
                    if($partylistData->name == $candidate_new_data->party)
                    {
                        $candidate->partylist_id = $partylistData->partylist_id;
                    }
                }

                foreach($position as $positionData){
                    if($positionData->name == $candidate_new_data->position)
                    {
                        $candidate->position_id = $positionData->position_id;
                    }
                }

                foreach($organization as $organizationData){
                    if($organizationData->name == $candidate_new_data->organization)
                    {
                        $candidate->organization_id = $organizationData->organization_id;
                    }
                }

                if ($candidate_new_data->middle_name) {
                    $candidate->name = $candidate_new_data->last_name . ' ' . $candidate_new_data->first_name . ' ' . substr($candidate_new_data->middle_name, 0, 1) . '.';
                } else {
                    $candidate->name = $candidate_new_data->last_name . ' ' . $candidate_new_data->first_name;
                }
                
                $candidate->save();
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    //! pang hashed ni
    function hash(){
        try {
            $voters = voters::all();
            $voterNotHashed = [];
            
            foreach($voters as $voterdata){
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
}
