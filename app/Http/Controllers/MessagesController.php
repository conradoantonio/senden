<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Business;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = $title = "Mensajeria";
        if ( auth()->user()->user_type_id == 1 ){
        	$messages = Message::leftJoin('businesses','businesses.id','=','messages.business_id')
        					->where('to_id',0)
        					->select('messages.*', 'businesses.name')
        					->orderBy('messages.created_at','DESC')
        					->get();
        	$datos_negocio = null;
        } else if ( auth()->user()->user_type_id == 3 ) {
        	$messages = Message::where('to_id',auth()->user()->business_id)
        					->leftJoin('businesses','businesses.id','=','messages.business_id')
        					->select('messages.*', 'businesses.name')
        					->orderBy('messages.created_at','DESC')
        					->get();
        	$datos_negocio = Business::find(auth()->user()->business_id);
        }
        $businesses = Business::all();
        #dd($messages);
        return view('admin.messages.index',['menu' => $menu, 'title' => $title, 'messages'=>$messages, 'businesses' => $businesses, 'datos_negocio' => $datos_negocio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();

        $message->business_id = $request->business_id;
        $message->subject = $request->subject;
        $message->from = $request->from;
        $message->body = $request->body;
        $message->to_id = $request->to_id;

        $message->save();

        if ( auth()->user()->user_type_id == 1 ){
        	$messages = Message::leftJoin('businesses','businesses.id','=','messages.business_id')
        					->where('to_id',0)
        					->select('messages.*', 'businesses.name')
        					->orderBy('messages.created_at','ASC')
        					->get();
        	$datos_negocio = null;
        } else if ( auth()->user()->user_type_id == 3 ) {
        	$messages = Message::where('to_id',auth()->user()->business_id)
        					->leftJoin('businesses','businesses.id','=','messages.business_id')
        					->select('messages.*', 'businesses.name')
        					->orderBy('messages.created_at','ASC')
        					->get();
        }
        return $messages;
    }

    public function status(Request $req){
    	$mensaje = Message::find($req->id);
    	$mensaje->check = 0;
    	$mensaje->save();

    	$count = $this->count_messages();
    	echo $count;
    }

    public static function count_messages(){
    	$query = Message::where('check',1);

    	if ( auth()->user()->user_type_id == 1 ){
    		$query->where('to_id','=',0);
    	} else if( auth()->user()->user_type_id == 3 ){
    		$query->where('to_id','!=',0);
    	}

    	$count = $query->count();
    	return $count;
    }
}
