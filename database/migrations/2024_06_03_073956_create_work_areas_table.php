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
        Schema::create('work_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staffs')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('work_areas');
    }
};
