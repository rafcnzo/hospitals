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
        Schema::create('kode_tindakan_terapi', function (Blueprint $table) {
            $table->integer('idkode_tindakan_terapi')->primary()->autoIncrement();
            $table->string('kode', 5);
            $table->string('deskripsi_tindakan_terapi', 1000);
            $table->integer('idkategori');
            $table->integer('idkategori_klinis');
            
            $table->foreign('idkategori')->references('idkategori')->on('kategori')->onDelete('cascade');
            $table->foreign('idkategori_klinis')->references('idkategori_klinis')->on('kategori_klinis')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_tindakan_terapi');
    }
};
