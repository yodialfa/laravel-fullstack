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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_resi');
            $table->string('dopo')->nullable();
            $table->string('no_hp_pengirim');
            $table->string('nama_pengirim');
            $table->string('alamat_pengirim');
            $table->string('no_hp_penerima');
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->foreignId('IdLayanan');
            $table->foreignId('IdKotaAsal');
            $table->foreignId('IdKecAsal');
            $table->foreignId('IdKotaTujuan');
            $table->foreignId('IdKecTujuan');
            $table->string('cara_bayar');
            $table->integer('jumlah');
            $table->integer('berat');
            $table->integer('harga');
            $table->float('diskon');
            $table->float('biaya_surat');
            $table->string('jenis_barang');
            $table->float('biaya_asuransi');
            $table->float('total_harga');
            $table->foreignId('employeeId');
            $table->char('status',10)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
