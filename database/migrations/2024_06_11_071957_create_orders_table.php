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
            $table->unsignedBigInteger('staff_id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('price');
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
            $table->timestamps();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staffs')
                ->cascadeOnDelete();
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
