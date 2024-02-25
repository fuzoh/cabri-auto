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
        Schema::create('parent_participant_at_camps', function (Blueprint $table) {
            $table->id();
            $table->boolean('get_participant');
            $table->boolean('get_in_car');
            $table->boolean('get_other_participant');
            $table->string('names');
            $table->foreignId('registration_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_participant_at_camps');
    }
};
