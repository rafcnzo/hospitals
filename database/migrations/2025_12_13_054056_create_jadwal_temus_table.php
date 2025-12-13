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
        Schema::create('jadwal_temu', function (Blueprint $table) {
            $table->id('idjadwal_temu'); // Primary Key

            // Tipe data disamakan dengan tabel Pet (unsignedBigInteger)
            $table->unsignedBigInteger('idpet');

            $table->dateTime('waktu_temu');
            $table->string('keterangan');

            // Status enum
            $table->enum('status', ['terjadwal', 'selesai', 'batal'])->default('terjadwal');

            $table->timestamps();

            // Foreign Key Constraint
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
        Schema::dropIfExists('jadwal_temu');
    }
};
