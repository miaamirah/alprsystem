<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registered_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('student_id');
            $table->string('plate_text')->unique();
            $table->string('vehicle_type'); // optional
            $table->string('brand');        // optional
            $table->string('color');        // optional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registered_vehicles');
    }
};
