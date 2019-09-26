<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Validator;

class FrontendController extends Controller
{
    

    public function contactUs(Request $request){
    	if($request->isMethod('post')){

          $data=$request->all();
          Validator::make($request->all(),[
           'name' => 'required|max:255',
            'email' => 'required|email',
            'subject'=>'required',

           ]);

          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
          $email="nafiz016@gmail.com";
          $messageData=[
              'name'=>$data['name'],
              'email'=>$data['email'],
              'subject'=>$data['subject'],
              'comments'=>$data['message']

          ];
          Mail::send('contact.email_query',$messageData,function($message)use($email){
          	$message->to($email)->subject('Enquiry from ecomer ');

          });

          

    	}

    	return view('contact.contact_us');
    }
}
