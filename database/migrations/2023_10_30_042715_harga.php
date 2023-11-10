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
        Schema::create('Cities', function (Blueprint $table) {
            $table->id();
            $table->string('NamaKota');
            $table->timestamps();
        });

        Schema::create('Districts', function (Blueprint $table) {
            $table->id();
            $table->string('NamaKecamatan');
            $table->foreignId('IdCities');
            $table->timestamps();
        });

        Schema::create('Services', function (Blueprint $table) {
            $table->id();
            $table->string('NamaLayanan');
            $table->timestamps();
        });

        Schema::create('Prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdKotaAsal');
            $table->foreignId('IdKecAsal');
            $table->foreignId('IdKotaTujuan');
            $table->foreignId('IdKecTujuan');
            $table->foreignId('IdLayanan');
            $table->float('Harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cities');
    }
};
