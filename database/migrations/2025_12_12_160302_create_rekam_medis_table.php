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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id('idrekam_medis');
            $table->timestamp('created_at')->useCurrent();
            $table->string('anamnesa', 1000);
            $table->string('temuan_klinis', 1000);
            $table->string('diagnosa', 1000);
            $table->unsignedBigInteger('idpet');
            $table->integer('dokter_pemeriksa');
            
            $table->foreign('idpet')
                  ->references('idpet')
                  ->on('pet')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
