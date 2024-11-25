<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referral_links', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('user_id');
            $table->string('referral_url')->nullable();
            $table->string('display_name')->nullable();
            $table->string('canonicalized_name')->nullable();
            $table->string('logo');
            $table->string('promo_terms');
            $table->string('promo_terms_url')->nullable();
            $table->string('promo_expiration_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('status');
            $table->string('expected_payout_by_referar')->nullable();
            $table->string('expected_payout_by_website')->nullable();
            $table->string('referee_share_percentage');
            $table->string('referral_share_percentage');
            $table->string('platform_percentage');
            $table->string('expected_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_links');
    }
};
