<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditMessageRequest;
use App\Models\Message;
use \Illuminate\Support\Carbon;

use App\Http\Requests\SetMessageRequest;
use App\Http\Requests\GetMessagesRequest;
use App\Http\Services\MessageService;

class MessageController extends Controller
{
    function __construct(private MessageService $messageService){
    }

    public function setMessage(SetMessageRequest $request){
        try{

            $messages = new Message();
            // build message
            $messages->user_sender_id = $request->input('sender');
            $messages->user_reciever_id = $request->input('reciever');
            $messages->message = $request->input('message');
            $messages->created_at = Carbon::now();
            $messages->updated_at = Carbon::now();
            $messages->save();

            return([
                'data' => $this->messageService->getlatestMessage($messages->user_sender_id, $messages->user_reciever_id),
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
            $result = $this->messageService->getLatestMessage($sender, $reciever);
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

    public function editMessage(EditMessageRequest $request){
        $message = $request->input('message');
        $sender = $request->input('sender');
        $reciever = $request->input('reciever');
        try{
            $messageToEdit = Message::find($request->input('id'));
            $messageToEdit->message = $message;
            $messageToEdit->updated_at = Carbon::now();

            $messageToEdit->save();

            return([
                'data' => $messageToEdit,
                'message' => 'Message updated successfully',
                'status' => 200,
            ]);
        }catch(\Exception $e){
            dd($e);
            return([
                'data' => '',
                'message' => 'Something went wrong when updating your message',
                'status' => 200,
            ]);
        }


    }
}
