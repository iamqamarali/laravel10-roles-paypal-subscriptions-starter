<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->uuid('id')->primary()->default(DB::raw('uuid()'));
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('temp_subscription_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            
            $table->string('password');
            $table->string('roles')->nullable();

            $table->boolean('should_change_password')->nullable();
            $table->boolean('should_choose_groups')->nullable();

            $table->json('data')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
