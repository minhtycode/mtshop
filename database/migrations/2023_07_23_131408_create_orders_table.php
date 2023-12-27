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
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_phone', 10)->nullable();
            $table->string('customer_email', 255)->nullable();
            $table->string('shipping_address', 255)->nullable();
            $table->string('note', 255);
            $table->decimal('total', 10, 2); // Sử dụng phương thức decimal() với precision = 10 và scale = 2
            $table->unsignedBigInteger('user_id'); // Thêm cột user_id để tạo khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');
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