<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral_links extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'user_id', 'referral_url', 'display_name', 'canonicalized_name', 'logo', 'promo_terms', 'promo_terms_url', 'promo_expiration_date', 'expiry_date', 'status', 'expected_payout_by_referar', 'expected_payout_by_website', 'offer_id', 'referee_share_percentage', 'referral_share_percentage', 'platform_percentage', 'expected_days'];
}
