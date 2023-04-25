<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message_table';

    protected $primary_key = 'id';
    public $timestamps = false;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'user_sender_id',
        'user_reciever_id',
        'message',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];
}
