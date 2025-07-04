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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('generated_by')->nullable; 
            $table->integer('total_vehicles_range')->default(0);
            $table->integer('total_vehicles_today')->default(0);
            $table->integer('flagged_vehicles_range')->default(0);
            $table->integer('flagged_vehicles_today')->default(0);
            $table->timestamp('timestamp_created')->useCurrent();
            $table->timestamps();

            $table->foreign('generated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
