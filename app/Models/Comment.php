<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment_table';

    protected $primary_key = 'id';
    public $timestamps = false;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    protected $fillable = ['parentCommentId', 'userId', 'comment', 'created_at', 'modified_at'];

    protected $hidden = ['id'];
}
