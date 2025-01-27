<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table ='admins';
    protected $fillable = [
                                'name',
                                'lastName',
                                'email',
                                'password',
                                'phone',
                                'avtar',
                                'gender',
                                'otp',
                                'role',
                                'plen_pass',
                                'status'
                            ];
}
