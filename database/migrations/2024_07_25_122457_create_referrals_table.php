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
        Schema::create('click_activity', function (Blueprint $table) {
            $table->date('date_pst'); 
            $table->text('click_timestamps');
            $table->unsignedBigInteger('referee_user_id'); 
            $table->unsignedBigInteger('referral_id');
            $table->string('date_referral_id_referee_user_id')->unique(); 
            $table->unsignedBigInteger('referrer_user_id'); 
            $table->enum('referee_confirmation_status', ['not_yet', 'opened']); 
            $table->text('referee_confirmation_snapshots')->default('N/A');
            $table->enum('referrer_paid_platform_fee', ['not_yet', 'paid', 'acknowledged']); 
            $table->text('referrer_paid_platform_fee_snapshots')->default('N/A'); 
            $table->enum('referrer_paid_referee', ['not_yet', 'paid', 'acknowledged']); 
            $table->text('referrer_paid_referee_snapshots')->default('N/A');
            $table->integer('transaction_ratings')->nullable(); 
            $table->text('transaction_comments')->nullable(); 

            $table->foreign('referee_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('referrer_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
