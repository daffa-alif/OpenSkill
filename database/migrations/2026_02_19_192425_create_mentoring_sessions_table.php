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
       Schema::create('mentoring_sessions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('mentee_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
        
        $table->string('topic_detail');
        $table->dateTime('scheduled_at');
        $table->enum('status', ['pending', 'accepted', 'completed', 'canceled'])->default('pending');
        
        // Tempat menyimpan link Google Meet / Zoom
        $table->string('meeting_link')->nullable(); 
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring_sessions');
    }
};
