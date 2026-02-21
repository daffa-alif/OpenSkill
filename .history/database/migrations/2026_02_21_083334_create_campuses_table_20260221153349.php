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
        Schema::create('campuses', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('point_system_name')->comment('Contoh: TAK, SKKM, dll');
                    $table->string('api_endpoint_url')->nullable()->comment('URL API portal akademik (misal: i-Grasias/SIAK)');
                    $table->string('api_key')->nullable();
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campuses');
    }
};
