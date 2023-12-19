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
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('cabang', 100);
            $table->string('alamatCabang');
            $table->timestamps();
        });

        Schema::create('agens', function (Blueprint $table) {
            $table->id();
            $table->string('agen', 100);
            $table->foreignId('cabang_id');
            $table->string('alamatAgen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
