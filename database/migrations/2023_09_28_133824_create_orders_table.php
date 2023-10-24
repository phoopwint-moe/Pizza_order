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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->longText('message')->nullable();
            $table->string('order_code');
            $table->integer('total_price')->nullable();
            $table->integer('status')->default(0); //0->pending, 1->success, 2->reject
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
