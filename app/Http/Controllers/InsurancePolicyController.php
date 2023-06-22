<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InsurancePolicy;
use Carbon\Carbon;

class InsurancePolicyController extends Controller
{
    //
    public function get_All_Policies(Request $request)
    {
        $participants = new InsurancePolicy();
        $data = $participants->fetchFilters(
            $request->start,
            $request->length,
            $request->order[0]['column'],
            $request->order[0]["dir"],
            $request->search['value'],
        );
        return [
            "draw" => $request->draw,
            "recordsTotal" => $data['total'],
            "recordsFiltered" => $data['filtered'],
            "data" => $data['data']
        ];
    }

    public function create_Policy(Request $request)
    {
        $formFields = $request->validate([
            'type' => ['required'],
            'description' => ['required', 'min:8'],
            'holdersFirstName' => ['required', 'min:3'],
            'holdersLastName' => ['required', 'min:3'],
            'holdersPhoneNumber' => ['required', 'numeric', 'digits:10'],
            'dateFrom' => ['required', 'date'],
            'dateTo' => ['required', 'date'],
        ]);
        $participantFields = Validator::make($request->all(), [
            'participants.*.firstName' => ['required', 'min:3'],
            'participants.*.lastName' => ['required', 'min:3'],
            'participants.*.birthdate' => ['required', 'date'],
        ]);
        $formFields['dateFrom'] = Carbon::parse($formFields['dateFrom'])->toDateString();
        $formFields['dateTo'] = Carbon::parse($formFields['dateTo'])->toDateString();
        if ($formFields['type'] == "Group") {
            if ($participantFields->fails()) {
                return response()->json("Participants fields are empty!", 422);
            }
            $policy = InsurancePolicy::create([
                'type' => $formFields['type'],
                'description' => $formFields['description'],
                'holder_name' => $formFields['holdersFirstName'],
                'holder_surname' => $formFields['holdersLastName'],
                'holder_phone' => $formFields['holdersPhoneNumber'],
                'date_from' =>  $formFields['dateFrom'],
                'date_to' =>  $formFields['dateTo']
            ]);
            foreach ($request->participants as $participant) {
                $birthdate =  Carbon::parse($participant['birthdate'])->toDateString();
                $policy->participants()->create([
                    'name' => $participant['firstName'],
                    'surname' => $participant['lastName'],
                    'birthdate' => $birthdate
                ]);
            }
            return response()->json("Success in getting policy!", 200);
        }
        $policy = InsurancePolicy::create([
            'type' => $formFields['type'],
            'description' => $formFields['description'],
            'holder_name' => $formFields['holdersFirstName'],
            'holder_surname' => $formFields['holdersLastName'],
            'holder_phone' => $formFields['holdersPhoneNumber'],
            'date_from' =>  $formFields['dateFrom'],
            'date_to' =>  $formFields['dateTo']
        ]);
        return response()->json("Success in getting policy!", 200);
    }

    public function delete_Policy($id)
    {
        $policy = InsurancePolicy::where('id', $id)->delete();
        if ($policy >= 1) {
            return response()->json(["message" => "You have deleted this policy!"], 200);
        }
        return response()->json(["error" => "You have deleted this policy!"], 404);
    }
}
