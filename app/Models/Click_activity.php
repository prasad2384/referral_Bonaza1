<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click_activity extends Model
{
    use HasFactory;

    protected $table = 'click_activity';

    protected $fillable = [
        'date_pst',
        'click_timestamps',
        'referee_user_id',
        'referral_id',
        'date_referral_id_referee_user_id',
        'referrer_user_id',
        'referee_confirmation_status',
        'referee_confirmation_snapshots',
        'referrer_paid_platform_fee',
        'referrer_paid_platform_fee_snapshots',
        'referrer_paid_referee',
        'referrer_paid_referee_snapshots',
        'transaction_ratings',
        'transaction_comments',
        'rating_status'
    ];

    // Define if timestamps should be managed by Eloquent (created_at, updated_at)
    public $timestamps = true;

}
