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
        Schema::create('detail_rekam_medis', function (Blueprint $table) {
            $table->id('iddetail_rekam_medis');
            $table->unsignedBigInteger('idrekam_medis');
            $table->integer('idkode_tindakan_terapi');
            $table->string('detail', 1000);
            
            $table->foreign('idrekam_medis')
                  ->references('idrekam_medis')
                  ->on('rekam_medis')
                  ->onDelete('cascade');
                  
            $table->foreign('idkode_tindakan_terapi')
                  ->references('idkode_tindakan_terapi')
                  ->on('kode_tindakan_terapi')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rekam_medis');
    }
};
