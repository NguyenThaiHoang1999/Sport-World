<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Events\RedisEvent;


class RedisController extends Controller
{
    public function index(){
        $messages = Messages::all();
        return view('messages', compact('messages'));
    }

    public function postSendMessage(Request $request){
    	$messages = Messages::create($request->all());
    	event(
    		$e = new RedisEvent($messages)
    	);
    	return redirect()->back();
    }

}
