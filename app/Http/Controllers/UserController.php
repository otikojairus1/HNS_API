<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Review;
use App\Models\Schedule;
use App\Models\Occurence;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // dd($request);
        $rules = [
            'email' => 'unique:users|required',
            'AccountType' => 'required',
            'password' => 'required',
        ];

        $input     = $request->only('email', 'AccountType','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $emailId = $request->email;
        $AccountType = $request->AccountType;
        $password = $request->password;
        // $phone = $request->phone;
        $user     = User::create(['email' => $emailId, 'accountType' => $AccountType, 'password' => Hash::make($password)]);
        //$token = $request->name->createToken('accessToken');
        return response()->json(['success' => true, 'message' => 'user has registered successfully.', "data"=>$user]);
        // return response()->json(["woork"=>"yee"]);
    }





    public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $input     = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            return response()->json(['success'=>true,'userDetails'=>$user ], 200);
        }
        else{
            return response()->json(['success'=>false,'error'=>'wrong login credentials' ], 200);
        }
    }

    public function login1(Request $request){
        $rules = [
            'emailId' => 'required',
            'password' => 'required',
        ];

        $input     = $request->only('emailId','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $emailId = $request->emailId;
        $password = $request->password;

        $userlogged = Account::where(['emailId'=>$emailId, 'password'=>$password])->first();

        if($userlogged){
            return response()->json(['success'=>true,'data'=>$userlogged ], 200);
        }else{
            return response()->json(['success'=>false,'error'=>'wrong login credentials' ],200);
        }

    }

    public function addMeeting(Request $request){

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'time' => 'required',

        ];

        $input     = $request->only('title','description', 'time');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        
        $meeting = Meeting::create(['title'=>$request->title, 'description'=>$request->description,'time'=>$request->time]);

        return response()->json(['success' => true, 'data'=>$meeting]);

    }

public function viewMeetings(){
    $allMeetings = Meeting::all();
    return response()->json(['success' => true, 'data'=>$allMeetings]);
}

public function addSchedule(Request $request){
    $rules = [
        'title' => 'required',
        'description' => 'required',
        'operator' => 'required',
        'careplan' => 'required',
        'time' => 'required',

    ];

    $input     = $request->only('title','description','time', 'operator','careplan');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }

    $schedule = Schedule::create(['title'=>$request->title, 'time'=>$request->time, 'description'=>$request->description,'operator'=>$request->operator,'careplan'=>$request->careplan]);

    return response()->json(['success' => true, 'data'=>$schedule]);

}

public function viewSchedules(){
    $allSchedules = Schedule::all();
    return response()->json(['success' => true, 'data'=>$allSchedules]);
}


public function addOccurence(Request $request){
    $rules = [
        'title' => 'required',
        'description' => 'required',
        'time' => 'required',

    ];

    $input     = $request->only('title','description','time');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }

    $occurence = Occurence::create(['title'=>$request->title, 'time'=>$request->time, 'description'=>$request->description]);

    return response()->json(['success' => true, 'data'=>$occurence]);

}


public function getOccurence(){
    $allSchedules = Occurence::all();
    return response()->json(['success' => true, 'data'=>$allSchedules]);
}

   


}
