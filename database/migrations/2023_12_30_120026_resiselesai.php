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
        Schema::create('resiselesai', function (Blueprint $table) {
            $table->id();
            $table->char('no_resi',20);
            $table->char('status', 5);
            $table->char('ket', 100);
            $table->char('ybs', 20)->nullable();
            $table->string('bukti_penerimaan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resiselesai');
    }
};
