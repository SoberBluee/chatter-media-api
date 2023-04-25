<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Messages;
// use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @property int $id
 * @property string $user_name
 * @property string first_name
 * @property string sur_name
 * @property string email
 * @property int $phonenumber
 * @property string password
 * @property int post_id
 * @property int message_id
 * @property string friend_list
 * @property string remember_token
 * @property Messages messages
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    protected $primary_key = "id";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'sur_name',
        'email',
        'password',
        'phonenumber',
        'messages',
        'post_id',
        'message_id',
        'friend_list',
        'email_verified_at',
        'remember_token',
        'messages',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_number' => 'int',
        'email_verified_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class, 'message_id');
    }
}
