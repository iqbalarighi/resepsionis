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
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('idtamu', 20)->unique();
            $table->string('email');
            $table->string('nama_lengkap');
            $table->string('institusi');
            $table->string('lantai');
            $table->text('kunjungan');
            $table->text('selfie')->nullable();
            $table->text('identitas')->nullable();
            $table->string('konfirmasi');
            $table->time('jam_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamu');
    }
};
