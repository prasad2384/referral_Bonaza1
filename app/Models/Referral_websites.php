<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral_websites extends Model
{
    use HasFactory;
    protected $table = 'referral_websites';

    protected $fillable = [
        'category_id',
        'user_id',
        'canonicalized_name',
        'logo',
        'expiry_date',
        'promo_terms',
        'promo_terms_url',
        'promo_expiration_date',
        'status',
        'expected_payout',
        'referee_share_percentage',
        'referral_share_percentage',
        'platform_percentage',
        'expected_days',
    ];

    protected $dates = ['expiry_date'];
}
