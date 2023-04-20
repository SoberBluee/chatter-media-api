<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MessageService
{
    /**
     * Get latests message from the server by sender and reciever id
     *
     * @param string $sender
     * @param string $reciever
     */
    public function getLatestMessage($sender, $reciever)
    {
        return DB::table('message_table')
            ->where(['user_sender_id' => $sender, 'user_reciever_id' => $reciever])
            ->orWhere(['user_sender_id' => $reciever, 'user_reciever_id' => $reciever])
            ->get();
    }
}
