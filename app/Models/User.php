<?php

namespace App\Models;

use App\Contracts\UserContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use SoftDeletes;
	use FilterTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	protected function name(): Attribute
	{
		return Attribute::make(
			get: fn ($value, $attributes) => "{$attributes['first_name']} {$attributes['last_name']}"
		);
	}

	public function password(): Attribute
	{
		return Attribute::make(
			set: fn($value) => Hash::make($value)
		);
	}

    public static function getUserList(): Object
    {
        return User::query()
            ->select(
                UserContract::FIELD_ID,
                UserContract::FIELD_FIRST_NAME,
                UserContract::FIELD_LAST_NAME,
            )
            ->orderBy(
                UserContract::FIELD_FIRST_NAME
            )
            ->get();
    }
}
