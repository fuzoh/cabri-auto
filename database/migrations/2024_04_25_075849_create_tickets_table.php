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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('transport_type', ['special_train', 'car', 'autonomous']);
            $table->enum('transport_location', ['Bienne', 'Lausanne', 'Neuchatel', 'Yverdon', 'Montreux', 'Nyon', 'Bulle', 'Morges'])->nullable();
            $table->string('location_autonomous')->nullable();
            $table->integer('baby_count')->default(0)->nullable();
            $table->integer('adult_count')->default(0)->nullable();
            $table->string('companion_names')->nullable();
            $table->foreignId('registration_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
