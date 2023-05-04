<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\EditMessageRequest;
use App\Models\Message;
use \Illuminate\Support\Carbon;

use App\Http\Requests\SetMessageRequest;
use App\Http\Requests\GetMessagesRequest;
use App\Http\Services\MessageService;

class MessageController extends Controller
{
    function __construct(private MessageService $messageService)
    {
    }

    public function testFunction()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e);
        }
    }

    public function setMessage(SetMessageRequest $request)
    {
        try {
            $messages = new Message();
            // build message
            $messages->user_sender_id = $request->input('sender');
            $messages->user_reciever_id = $request->input('reciever');
            $messages->message = $request->input('message');
            $messages->created_at = Carbon::now();
            $messages->updated_at = Carbon::now();
            $messages->save();

            return response()->json([
                'data' => $this->messageService->getLatestMessage($messages->user_sender_id, $messages->user_reciever_id),
                'message' => 'Messages sent',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => "Something went wrong trying to send your message"
            ], 400);
        }
    }

    /**
     * Gets messges by senderId and recieverId
     */
    public function getMessages(GetMessagesRequest $request)
    {
        try {
            $sender = $request->input('senderId');
            $reciever = $request->input('recieverId');
            // return messages that are of the currently logged in user and the selectedUser from the sidebar
            $result = $this->messageService->getLatestMessage($sender, $reciever);

            return response()->json([
                'data' => $result,
                'message' => 'Successfully fetched user messages'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Failed to fetch messages'
            ], 400);
        }
    }

    /**
     * Deletes message but keeps row in db
     * @param string $messageId
     */
    public function deleteMessages($messageId)
    {
        assert($messageId !== null, 'Please provide a messageId');

        try {
            // Find message to delete
            $messageToDelete = Message::find($messageId);
            $messageToDelete->message = 'Message has been deleted';
            $messageToDelete->save();

            return response()->json([
                'data' => $messageToDelete,
                'message' => 'Message has been delted',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something weng wrong with deleting your message',
            ], 400);
        };
    }

    public function editMessage(EditMessageRequest $request)
    {
        $message = $request->input('message');
        $sender = $request->input('sender');
        $reciever = $request->input('reciever');
        try {
            $messageToEdit = Message::find($request->input('id'));
            $messageToEdit->message = $message;
            $messageToEdit->updated_at = Carbon::now();

            $messageToEdit->save();

            return response()->json([
                'data' => $messageToEdit,
                'message' => 'Message was updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something went wrong when updating your message'
            ], 400);
        }
    }
}
