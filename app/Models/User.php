<?php

namespace App\Models;

use App\Models\Helpers\UserHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function validatePassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function login()
    {
        $this->generateApiToken();
        Auth::login($this);
        
        return $this;
    }

    public function generateApiToken()
    {
        $apiToken = Str::random(100);
        
        $existToken = UserHelper::findByApiToken($apiToken);

        if ($existToken instanceof User)
        {
            return $this->generateApiToken();
        }

        $this->api_token = $apiToken;
        return $this;
    }
}
