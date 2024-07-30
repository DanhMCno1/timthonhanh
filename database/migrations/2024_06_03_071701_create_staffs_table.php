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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->boolean('gender');
            $table->text('description');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('ward_id');
            $table->string('hamlet');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->cascadeOnDelete();

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->cascadeOnDelete();

            $table->foreign('ward_id')
                ->references('id')
                ->on('wards')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
