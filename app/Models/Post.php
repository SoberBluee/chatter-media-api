<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'post_table';

    protected $primary_key = 'id';
    public $timestamps = false;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'userId');
    }

    protected $fillable = [
        'id',        'userId',
        'title',
        'img',
        'body',
        'comment_id',
        'created_at',
    ];
}
