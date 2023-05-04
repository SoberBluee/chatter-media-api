<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    private $parentCommentId;
    private $postId;
    private $userId;
    private $comment;

    use HasFactory;

    protected $table = 'comment_table';

    protected $primary_key = 'id';
    public $timestamps = false;

    public function __construct()
    {
    }

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    protected $fillable = ['id', 'parentCommentId', 'postId', 'userId', 'comment', 'created_at', 'modified_at'];

    protected $hidden = [];
}
