<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use HasFactory;
    protected $fillable=['firstname','lastname','email','password','usertype','verification_code','verification_expires_at'];
}
