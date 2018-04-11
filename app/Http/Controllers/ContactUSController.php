<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ContactUS;
use Illuminate\Support\Facades\Validator;
use Session;
use Mail;


class ContactUSController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUS()
    {
        return view('contactUS');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUSPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'last_name' => 'required',
          'first_name' => 'required',
          'email' => 'required|email',
          'message' => 'required'
        ]);

        if ($validator->fails()) {
          return view('contactUS', compact('request'))->withErrors($validator);
        }

        ContactUS::create($request->all());

        // $data = [
        // 	'name'=> $request->last_name.' '.$request->first_name,
        // 	'email'=> $request->email,
        // 	'body_message'=> $request->message,
      	// ];
        //
      	// Mail::send('contactUS',$data, function($message) use ($data){
        //
      	// 	$message->from($data['email']);
      	// 	$message->to(env('MAIL_USERNAME'));
      	// 	$message->subject('Test Subject');
        //   $message->setBody($data['body_message']);
        //
      	// });

        return view('contactUS')->with('success', 'Thanks for contacting us!');
    }
}
