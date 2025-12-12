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
        Schema::create('pet', function (Blueprint $table) {
            $table->id('idpet');
            $table->string('nama', 100);
            $table->date('tanggal_lahir');
            $table->string('warna_tanda', 45);
            $table->char('jenis_kelamin', 1);
            $table->unsignedBigInteger('idpemilik');
            $table->unsignedBigInteger('idras_hewan');
            $table->timestamps();
            
            $table->foreign('idpemilik')
                  ->references('idpemilik')
                  ->on('pemilik')
                  ->onDelete('cascade');
                  
            $table->foreign('idras_hewan')
                  ->references('idras_hewan')
                  ->on('ras_hewan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet');
    }
};
