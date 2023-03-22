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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->index();
            $table->foreign("user_id")->references("id")->on("users");

            $table->foreignId("product_id")->nullable();
            $table->foreign("product_id")->references("id")->on("products");

            $table->foreignId("group_id")->nullable();
            $table->foreign("group_id")->references("id")->on("groups");

            $table->string('status', 100);
            $table->string('paypal_subscription_id', 80);
            $table->string('paypal_plan_id', 80);

            $table->timestamp('start_date')->nullable();
            $table->timestamp('next_billing_date')->nullable();
            $table->float('price');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
