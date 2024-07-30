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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('rating');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staffs')
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
