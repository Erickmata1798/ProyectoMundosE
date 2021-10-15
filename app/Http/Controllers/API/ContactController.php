<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    public function store(Request $request){

        $validator =  Validator::make($request->all(),[
        'name'=>'required|max:191',
        'email'=>'required|email|max:191',
        'phone'=>'required|max:8|min:8',
        'message'=>'required|max:191'
        ]);
        if($validator->fails()){
            return response()->json([
                'validate_err'=>$validator->messages(),
            ]);
        }else{

        
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->message = $request->input('message');
        $contact->save();

        return response()->json([
            'status'=>200,
            'message'=>'Contact Added Successfully',
        ]);
        }
    }
    
}
