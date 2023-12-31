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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('NIM');
            $table->string('judul');
            $table->string('jenis_sidang');
            $table->string('dosen_pembimbing');
            $table->string('berkas');
            $table->date('jadwal_sidang')->nullable();
            $table->time('pukul')->nullable();
            $table->string('link_zoom')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
