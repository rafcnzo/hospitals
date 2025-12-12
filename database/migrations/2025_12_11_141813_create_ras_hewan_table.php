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
        Schema::create('ras_hewan', function (Blueprint $table) {
            $table->id('idras_hewan');
            $table->string('nama_ras', 100);
            $table->unsignedBigInteger('idjenis_hewan');
            $table->timestamps();
            
            $table->foreign('idjenis_hewan')
                  ->references('idjenis_hewan')
                  ->on('jenis_hewan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras_hewan');
    }
};
