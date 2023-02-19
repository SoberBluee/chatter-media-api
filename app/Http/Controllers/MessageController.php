<?php

namespace App\Http\Controllers;

use App\Models\Message;
use \Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SetMessageRequest;
use App\Http\Requests\GetMessagesRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function testFunction(){
        dd(DB::table('message_table')->where('id', 1)->get());
        return([
            'data' => 'something'
        ]);
    }

    public function setMessage(SetMessageRequest $request){
        try{

            $messages = new Message();

            $messages->user_sender_id = $request->input('sender');
            $messages->user_reciever_id = $request->input('reciever');
            $messages->message = $request->input('message');
            $messages->created_at = Carbon::now();
            $messages->updated_at = Carbon::now();

            $messages->save();

            return([
                'data' => $messages->toArray(),
                'message' => 'messages created successfully',
                'status' => 200,
            ]);

        }catch(\Exception $e){
            return([
                'data' => '',
                'message' => $e->getMessage(),
                'status' => 400,
            ]);
        }
    }

    public function getMessages(GetMessagesRequest $request){
        try{
            $sender = $request->input('senderId');
            $reciever = $request->input('recieverId');
            // return messages that are of the currently logged in user and the selectedUser from the sidebar
            $result = DB::table('message_table')
                ->where(['user_sender_id' => $sender, 'user_reciever_id' => $reciever])
                ->orWhere(['user_sender_id'=> $reciever, 'user_reciever_id' => $reciever])
                ->get();
            return([
                'data' => $result,
                'message'=> "",
                "status" => 200,
            ]);
        }catch(\Exception $e){
            return([
                'data' => '',
                'message'=> 'failed to get messages',
                'status' => 400,
            ]);
        }

    }

    public function deleteMessages(){
        dd("del");

    }

    public function editMessage(){
        dd("edit");

    }
}
